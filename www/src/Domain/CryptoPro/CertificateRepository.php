<?php

namespace App\Domain\CryptoPro;

use App\Libraries\CryptoPro\CAdESCOM\CPStore;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPCertificate;

interface CertificateRepository
{
    public function getStore(): CPStore;

    /**
     * @return ICPCertificate[]
     */
    public function all(): array;

    /**
     * @param int $findType
     * @param string $query
     * @param bool $validOnly
     * @return ICPCertificate|null
     */
    public function find(int $findType, string $query, bool $validOnly = false);
}