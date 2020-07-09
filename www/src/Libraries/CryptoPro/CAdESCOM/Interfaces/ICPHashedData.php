<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPHashedData
{
//    public function Hash();

    public function SetHashValue(string $hash): void;

//    public function get_Value();
//
//    public function set_Key();
//
//    public function get_Key();

    /**
     * @param int $algorithm CAPICOM_HASH_ALGORITHM
     */
    public function set_Algorithm(int $algorithm): void;

    public function get_Algorithm(): int;

    /**
     * @param int $encodingType CADESCOM_CONTENT_ENCODING_TYPE
     */
    public function set_DataEncoding(int $encodingType): void;

    public function get_DataEncoding(): int;
}