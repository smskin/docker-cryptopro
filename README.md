# PHP CryptoPro Service (docker) with HTTP API

## Installation
* copy env-example to .env
* change LICENSE for set license or use trial (90 days)
* add private and public keys to ./certificates folder
* change PUBLIC_KEY_FILE_NAME & PRIVATE_KEY_FOLDER_NAME for install keys to cryptopro
* change CRYPTOPRO_LOGIN & CRYPTOPRO_PASSWORD variables (if cryptopro blocked credentials from example)
* add certificate for import to folder certificate
* run docker-compose build


## Docker
Container based on phusion image.

Installed services:
- PHP 7.3 (CLI & FPM)
- NGINX
- CryptoPro PHP extension

## HTTP API
Swagger documentation: http://localhost:81/docs/index.html

Methods:
- Get certificates list
- Sign file
- Verify file signature
