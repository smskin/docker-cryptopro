<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPCertificates
{
    const CERTIFICATE_FIND_SHA1_HASH = 0;
    const CERTIFICATE_FIND_SUBJECT_NAME = 1;

    public function Find(int $findType, string $query, bool $validOnly): ICPCertificates;

    public function Item(int $key): ICPCertificate;

    public function Count(): int;
}