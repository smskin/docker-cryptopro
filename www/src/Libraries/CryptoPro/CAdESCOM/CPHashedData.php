<?php
/** @noinspection PhpUndefinedClassInspection */

namespace App\Libraries\CryptoPro\CAdESCOM;

use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPHashedData;

class CPHashedData extends \CPHashedData implements ICPHashedData
{
    public function SetHashValue(string $hash): void
    {
        parent::SetHashValue($hash);
    }

    /**
     * @param int $algorithm CAPICOM_HASH_ALGORITHM
     */
    public function set_Algorithm(int $algorithm): void
    {
        parent::set_Algorithm($algorithm);
    }

    public function get_Algorithm(): int
    {
        return parent::get_Algorithm();
    }

    /**
     * @param int $encodingType CADESCOM_CONTENT_ENCODING_TYPE
     */
    public function set_DataEncoding(int $encodingType): void
    {
        parent::set_DataEncoding($encodingType);
    }

    public function get_DataEncoding(): int
    {
        return parent::get_DataEncoding();
    }
}