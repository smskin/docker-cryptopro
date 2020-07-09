<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPEKUs
{
    public function Add();

    public function get_Count();

    public function get_Item();

    public function Clear();

    public function Remove();
}