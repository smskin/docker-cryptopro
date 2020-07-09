<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPOID
{
    public function get_Value(): string;

    public function set_Value(string $value): void;

    public function get_FriendlyName(): string;
}