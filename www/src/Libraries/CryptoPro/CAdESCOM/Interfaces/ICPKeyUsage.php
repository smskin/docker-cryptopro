<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPKeyUsage
{
    public function get_IsPresent();

    public function get_IsCritical();

    public function get_IsDigitalSignatureEnabled();

    public function get_IsNonRepudiationEnabled();

    public function get_IsKeyEnciphermentEnabled();

    public function get_IsDataEnciphermentEnabled();

    public function get_IsKeyAgreementEnabled();

    public function get_IsKeyCertSignEnabled();

    public function get_IsCRLSignEnabled();

    public function get_IsEncipherOnlyEnabled();

    public function get_IsDecipherOnlyEnabled();
}