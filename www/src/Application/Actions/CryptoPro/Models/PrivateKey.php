<?php

namespace App\Application\Actions\CryptoPro\Models;

use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPPrivateKey;

/**
 * Class PrivateKey
 * @package App\Application\Actions\CryptoPro\Models
 *
 * @OA\Schema(
 *     title="PrivateKey",
 *     description="Private key model",
 * )
 */
class PrivateKey
{
    /**
     * @var string
     *
     * @OA\Property()
     */
    public $containerName;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $uniqueContainerName;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $providerName;

    /**
     * PrivateKey constructor.
     * @param ICPPrivateKey $privateKey
     */
    public function __construct($privateKey)
    {
        $this
            ->setContainerName($privateKey->get_ContainerName())
            ->setUniqueContainerName($privateKey->get_UniqueContainerName())
            ->setProviderName($privateKey->get_ProviderName());
    }

    /**
     * @param string $containerName
     * @return PrivateKey
     */
    public function setContainerName(string $containerName): PrivateKey
    {
        $this->containerName = $containerName;
        return $this;
    }

    /**
     * @param string $uniqueContainerName
     * @return PrivateKey
     */
    public function setUniqueContainerName(string $uniqueContainerName): PrivateKey
    {
        $this->uniqueContainerName = $uniqueContainerName;
        return $this;
    }

    /**
     * @param string $providerName
     * @return PrivateKey
     */
    public function setProviderName(string $providerName): PrivateKey
    {
        $this->providerName = $providerName;
        return $this;
    }
}