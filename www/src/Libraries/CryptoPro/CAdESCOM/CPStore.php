<?php
/** @noinspection PhpUndefinedClassInspection */

namespace App\Libraries\CryptoPro\CAdESCOM;

use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPCertificates;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPStore;

class CPStore extends \CPStore implements ICPStore
{
    /**
     * @param int $storeType CADESCOM_STORE_LOCATION
     * @param string $store
     * @param int $mode
     */
    public function Open(int $storeType, string $store, int $mode): void
    {
        parent::Open($storeType, $store, $mode);
    }

    public function Close(): void
    {
        parent::Close();
    }

    /**
     * @return ICPCertificates
     */
    public function get_Certificates()
    {
        return parent::get_Certificates();
    }

    public function get_Location(): int
    {
        return parent::get_Location();
    }

    public function get_Name(): string
    {
        return parent::get_Name();
    }
}