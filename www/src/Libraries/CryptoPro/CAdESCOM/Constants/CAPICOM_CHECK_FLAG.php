<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Constants;

/**
 * Class CAPICOM_CHECK_FLAG
 * @package App\Libraries\CryptoPro\CAdESCOM\Constants
 * https://docs.microsoft.com/ru-ru/windows/win32/seccrypto/capicom-check-flag
 */
class CAPICOM_CHECK_FLAG
{
    const CAPICOM_CHECK_NONE = 0;
    const CAPICOM_CHECK_TRUSTED_ROOT = 1;
    const CAPICOM_CHECK_TIME_VALIDITY = 2;
    const CAPICOM_CHECK_SIGNATURE_VALIDITY = 4;
    const CAPICOM_CHECK_ONLINE_REVOCATION_STATUS = 8;
    const CAPICOM_CHECK_OFFLINE_REVOCATION_STATUS = 16;
    const CAPICOM_CHECK_COMPLETE_CHAIN = 32;
    const CAPICOM_CHECK_NAME_CONSTRAINTS = 64;
    const CAPICOM_CHECK_BASIC_CONSTRAINTS = 128;
    const CAPICOM_CHECK_NESTED_VALIDITY_PERIOD = 256;
    const CAPICOM_CHECK_ONLINE_ALL = 495;
    const CAPICOM_CHECK_CHECK_OFFLINE_ALL = 503;
}