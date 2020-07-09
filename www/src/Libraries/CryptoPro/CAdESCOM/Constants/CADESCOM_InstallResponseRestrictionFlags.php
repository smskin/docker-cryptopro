<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Constants;

class CADESCOM_InstallResponseRestrictionFlags
{
    const CADESCOM_AllowNone = 0;
    const CADESCOM_AllowNoOutstandingRequest = 1;
    const CADESCOM_AllowUntrustedCertificate = 2;
    const CADESCOM_AllowUntrustedRoot = 4;
    const CADESCOM_SkipInstallToStore = 268435456;
}