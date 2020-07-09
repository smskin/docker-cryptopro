<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPSigners
{
    public function get_Count(): int;

    public function get_Item(int $key): ICPSigner;
}