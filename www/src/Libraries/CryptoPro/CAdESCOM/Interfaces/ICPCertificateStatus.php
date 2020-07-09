<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPCertificateStatus
{
    public function get_Result(): int;

    public function get_CheckFlag(): int;

    /**
     * @param int $checkFlag CAPICOM_CHECK_FLAG
     */
    public function set_CheckFlag(int $checkFlag): void;

    public function EKU(): ICPEKU;

    public function get_VerificationTime(): string;

    public function set_VerificationTime(int $time): void;

    public function get_UrlRetrievalTimeout(): int;

    public function set_UrlRetrievalTimeout(int $timeout): void;

    public function CertificatePolicies(): array;

    public function ApplicationPolicies(): array;

    public function get_ValidationCertificates();
}