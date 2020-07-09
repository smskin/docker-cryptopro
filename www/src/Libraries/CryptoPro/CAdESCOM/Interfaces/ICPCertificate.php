<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPCertificate
{
    /**
     * @param int $infoType CAPICOM_CERT_INFO_TYPE
     * @return string
     */
    public function GetInfo(int $infoType): string;

    public function FindPrivateKey();

    public function HasPrivateKey(): bool;

    public function IsValid(): ICPCertificateStatus;

    public function ExtendedKeyUsage(): ICPExtendedKeyUsage;

    public function KeyUsage(): ICPKeyUsage;

    public function Export();

    public function Import();

    public function get_SerialNumber(): string;

    public function get_Thumbprint(): string;

    public function get_SubjectName(): string;

    public function get_IssuerName(): string;

    public function get_Version(): int;

    public function get_ValidToDate(): string;

    public function get_ValidFromDate(): string;

    public function BasicConstraints(): ICPBasicConstraints;

    public function PublicKey(): ICPPublicKey;

    public function PrivateKey(): ICPPrivateKey;
}