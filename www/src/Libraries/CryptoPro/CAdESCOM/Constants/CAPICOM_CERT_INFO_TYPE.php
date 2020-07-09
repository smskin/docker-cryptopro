<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Constants;

/**
 * Class CAPICOM_CERT_INFO_TYPE
 * @package App\Libraries\CryptoPro\CAdESCOM\Constants
 * https://docs.microsoft.com/ru-ru/windows/win32/seccrypto/certificate-getinfo
 */
class CAPICOM_CERT_INFO_TYPE
{
    const CAPICOM_CERT_INFO_SUBJECT_SIMPLE_NAME = 0;
    const CAPICOM_CERT_INFO_ISSUER_SIMPLE_NAME = 1;
//    Not implemented. (0x80004001)
//    const CAPICOM_CERT_INFO_SUBJECT_EMAIL_NAME = 2;
//    const CAPICOM_CERT_INFO_ISSUER_EMAIL_NAME = 3;
//    const CAPICOM_CERT_INFO_SUBJECT_UPN = 4;
//    const CAPICOM_CERT_INFO_ISSUER_UPN = 5;
//    const CAPICOM_CERT_INFO_SUBJECT_DNS_NAME = 6;
//    const CAPICOM_CERT_INFO_ISSUER_DNS_NAME = 7;
}