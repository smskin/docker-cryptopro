<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPStore
{
    const STORE_OPEN_READ_ONLY = 0;

    public function Open(int $storeType, string $store, int $mode): void;

    public function Close(): void;

    /**
     * @return ICPCertificates
     */
    public function get_Certificates();

    public function get_Location(): int;

    public function get_Name(): string;
}