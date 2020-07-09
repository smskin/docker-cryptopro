<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPSigner
{
    const CERTIFICATE_INCLUDE_CHAIN_EXCEPT_ROOT = 0;
    const CERTIFICATE_INCLUDE_WHOLE_CHAIN = 1;
    const CERTIFICATE_INCLUDE_END_ENTITY_ONLY = 2;

    /**
     * @return ICPCertificate
     */
    public function get_Certificate();

    /**
     * @param ICPCertificate $certificate
     */
    public function set_Certificate($certificate): void;

    public function get_Options(): int;

    public function set_Options(int $option);

    /**
     * @return ICPAttributes
     */
    public function get_AuthenticatedAttributes();

    /**
     * @return ICPAttributes
     */
    public function get_UnauthenticatedAttributes();

    public function get_TSAAddress(): string;

    public function set_TSAAddress(string $address): void;

    public function get_CRLs(): array;

    public function get_OCSPResponses(): array;
//
//    public function get_SigningTime();
//
//    public function get_SignatureTimeStampTime();

    public function set_KeyPin(string $pin): void;
}