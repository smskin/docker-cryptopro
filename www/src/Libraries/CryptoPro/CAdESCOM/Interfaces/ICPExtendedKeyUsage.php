<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

/**
 * Interface ICPExtendedKeyUsage
 * @package App\Infrastructure\Persistence\CryptoProCSP\Interfaces
 *
 * https://docs.microsoft.com/ru-ru/windows/win32/seccrypto/extendedkeyusage?redirectedfrom=MSDN
 */
interface ICPExtendedKeyUsage
{
    public function get_IsPresent(): int;

    public function get_IsCritical(): int;

    public function get_EKUs(): ICPEKUs;
}