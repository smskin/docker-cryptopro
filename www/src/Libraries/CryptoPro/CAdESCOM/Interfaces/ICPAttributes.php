<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPAttributes
{
    public function Add();

    public function get_Count(): int;

    public function get_Item();

    public function Clear();

    public function Remove();

    public function Assign();
}