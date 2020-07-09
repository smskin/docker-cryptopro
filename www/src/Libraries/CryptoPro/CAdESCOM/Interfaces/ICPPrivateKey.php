<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPPrivateKey
{
    public function get_ContainerName(): string;

    public function get_UniqueContainerName(): string;

    public function get_ProviderName(): string;

    public function get_ProviderType(): int;

    public function get_KeySpec(): int;
}