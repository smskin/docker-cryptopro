<?php

namespace App\Infrastructure\Persistence\CryptoPro;

use \App\Domain\CryptoPro\CertificateRepository as ICertificateRepository;
use App\Libraries\CryptoPro\CAdESCOM\Constants\CADESCOM_STORE_LOCATION;
use App\Libraries\CryptoPro\CAdESCOM\CPStore;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPCertificate;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPStore;

class CertificateRepository implements ICertificateRepository
{
    /**
     * @var CPStore
     */
    protected $store;

    public function __construct()
    {
        $this->store = new CPStore();
        $this->store->Open(
            CADESCOM_STORE_LOCATION::CADESCOM_CURRENT_USER_STORE,
            'My',
            ICPStore::STORE_OPEN_READ_ONLY
        );
    }

    public function getStore(): CPStore
    {
        return $this->store;
    }

    /**
     * @return ICPCertificate[]
     */
    public function all(): array
    {
        $certs = $this->store->get_Certificates();
        $data = [];
        for ($i = 1; $i <= $certs->Count(); $i++) {
            $data[] = $certs->Item($i);
        }
        return $data;
    }

    /**
     * @param int $findType
     * @param string $query
     * @param bool $validOnly
     * @return ICPCertificate|null
     */
    public function find(int $findType, string $query, bool $validOnly = false)
    {
        $certs = $this->store->get_Certificates();
        $certs = $certs->Find($findType, $query, $validOnly);
        if ($certs->Count() === 0) {
            return null;
        }
        return $certs->Item(1);
    }
}