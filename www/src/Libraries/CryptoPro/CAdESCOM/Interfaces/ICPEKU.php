<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPEKU
{
    public function get_Name(): int;

    public function set_Name(int $name): void;

    public function get_OID(): string;

    public function set_OID(string $oid): void;
}