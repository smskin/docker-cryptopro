<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPPublicKey
{
    public function get_Algorithm(): ICPOID;

    public function get_Length();

    public function get_EncodedKey();

    public function get_EncodedParameters();
}