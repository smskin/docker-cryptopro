# Use phusion/baseimage as base image. To make your builds reproducible, make
# sure you lock down to a specific version, not to `latest`!
# See https://github.com/phusion/baseimage-docker/blob/master/Changelog.md for
# a list of version numbers.
FROM phusion/baseimage:bionic-1.0.0

# Use baseimage-docker's init system.
CMD ["/sbin/my_init"]

RUN mkdir -p /etc/my_init.d

RUN apt-get update

#####################################
# PHP 7.3:
#####################################
RUN add-apt-repository -y ppa:ondrej/php && \
    apt-get update

RUN apt-get install -y php7.3-fpm php7.3-cli && \
    mkdir /run/php && chown www-data:www-data -R /run/php && \
    mkdir /etc/service/php-fpm

COPY ./etc/php-fpm/www.conf /etc/php/7.3/fpm/pool.d/www.conf
COPY ./services/php-fpm /etc/service/php-fpm/run
RUN chmod +x /etc/service/php-fpm/run

#####################################
# Nginx:
#####################################

RUN apt-get install -y nginx && \
    echo "daemon off;" >> /etc/nginx/nginx.conf && \
    mkdir /etc/service/nginx
COPY ./etc/nginx/default /etc/nginx/sites-enabled/default
COPY ./services/nginx /etc/service/nginx/run
RUN chmod +x /etc/service/nginx/run

######################################
## CryptoPro:
## Based on:
## - https://github.com/dbfun/cryptopro
## - https://kinval.ru/ru/cades/phpcades-ubuntu-18-04
######################################
RUN apt-get install -y wget

COPY ./dist/csp.tgz /tmp/cryptopro/
RUN cd /tmp/cryptopro && \
    tar -xvzf csp.tgz && \
    ./linux-amd64_deb/install.sh && \
    cd / && \
    rm -rf /tmp/cryptopro

######################################
## CryptoPro PHP:
######################################
RUN apt-get install -y libboost-dev php7.3-dev libxml2-dev unzip

COPY ./dist/cades.tar.gz /tmp/cades/
COPY ./dist/php7_support.patch.zip /tmp/cades/

RUN PHP_VERSION_BUILD=`php -i | grep 'PHP Version => ' -m 1 | awk '{split($4,a," "); print a[1]}' | awk '{split($1,a,"-"); print a[1]}'` && \
    PHP_VERSION=`echo ${PHP_VERSION_BUILD} | awk '{split($1,a,"."); str = sprintf("%s.%s", a[1], a[2]); print str}'` && \
    PHP_EXT_DIR=`php -i | grep 'extension_dir => ' | awk '{print $3}'` && \
    # install cades plugin
    cd /tmp/cades && \
    tar -xvzf cades.tar.gz && \
    dpkg -i ./cades_linux_amd64/cprocsp-pki-cades-64_2.0.14071-1_amd64.deb && \
    dpkg -i ./cades_linux_amd64/lsb-cprocsp-devel_5.0.11863-5_all.deb && \
    dpkg -i ./cades_linux_amd64/cprocsp-pki-phpcades-64_2.0.14071-1_amd64.deb && \
    # download and configure php sources
    mkdir /tmp/php && \
    cd /tmp/php && \
    wget https://www.php.net/distributions/php-${PHP_VERSION_BUILD}.tar.gz && \
    tar -xf php-${PHP_VERSION_BUILD}.tar.gz && \
    cd php-${PHP_VERSION_BUILD} && \
    ./configure --prefix=/opt/php && \
    # compile php library
    cd /opt/cprocsp/src/phpcades && \
    unzip /tmp/cades/php7_support.patch.zip && \
    patch -p0 < ./php7_support.patch && \
    sed -i "s#PHPDIR=/php#PHPDIR=/tmp/php/php-${PHP_VERSION_BUILD}#g" /opt/cprocsp/src/phpcades/Makefile.unix && \
    eval `/opt/cprocsp/src/doxygen/CSP/../setenv.sh --64`; make -f Makefile.unix && \
    mv libphpcades.so ${PHP_EXT_DIR} && \
    echo "extension=libphpcades.so" > /etc/php/${PHP_VERSION}/cli/conf.d/20-libphpcades.ini && \
    echo "extension=libphpcades.so" > /etc/php/${PHP_VERSION}/fpm/conf.d/20-libphpcades.ini && \
    php -r "var_dump(class_exists('CPStore'));" | grep -q 'bool(true)' && \
    # clear
    cd / && \
    apt-get purge -y php7.3-dev cprocsp-pki-phpcades lsb-cprocsp-devel && \
    rm -rf /opt/cprocsp/src/phpcades && \
    rm -rf /tmp/cades && \
    rm -rf /tmp/php

#####################################
# Composer:
#####################################
RUN curl -s http://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Allow Composer to be run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

#####################################
#  Globalize:
#####################################
RUN echo "export PATH=${PATH}:/opt/cprocsp/bin/amd64:/opt/cprocsp/sbin/amd64:/var/www/html/vendor/bin" >> ~/.bashrc

#####################################
#  Project dependencies:
#####################################
RUN apt-get install -y php7.3-dom php7.3-mbstring

#####################################
#  Clean up APT:
#####################################
RUN apt-get autoremove -y && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

#####################################
#  Install certificate:
# http://pushorigin.ru/cryptopro/cryptcp
#####################################

COPY ./certificate /root/certificate
ARG PUBLIC_KEY_FILE_NAME=certificate.cer
ARG PRIVATE_KEY_FOLDER_NAME=test-sig.000

RUN cd /root/certificate && \
    CONT_FULL_NAME=`tail -c+5 "$PRIVATE_KEY_FOLDER_NAME/name.key"` && \
    echo "Key container short name: $PRIVATE_KEY_FOLDER_NAME" && \
    cp -R "$PRIVATE_KEY_FOLDER_NAME" /var/opt/cprocsp/keys/root/ && \
    echo -e "Key container installed" && \
    /opt/cprocsp/bin/amd64/certmgr -inst -file "$PUBLIC_KEY_FILE_NAME" -cont "\\\\.\\HDIMAGE\\$CONT_FULL_NAME" && \
    echo "Certificate installed with PrivateKey Link"

RUN cd /root/certificate && \
    wget -O root.pem "http://testca.cryptopro.ru/certsrv/certnew.cer?ReqID=CACert&Renewal=1&Mode=inst&Enc=b64" && \
    /opt/cprocsp/bin/amd64/certmgr -inst -all -store mroot -file root.pem && \
    echo "Root certificate installed"

RUN cd / && \
    rm -rf /root/certificate

#####################################
# Web interface:
#####################################
RUN rm -rf /var/www/html/*
COPY ./www /var/www/html

#####################################
#  Install composer dependencies:
#####################################
RUN cd /var/www/html && \
    composer install --no-dev

EXPOSE 80
WORKDIR /var/www/html