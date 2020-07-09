<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

use App\Libraries\CryptoPro\CAdESCOM\CPHashedData;
use App\Libraries\CryptoPro\CAdESCOM\CPSigner;

interface ICPSignedData
{
    /**
     * @param CPSigner $signer
     * @param int $cadesType CADESCOM_CADES_TYPE
     * @param bool $detached
     * @param int $encodingType CAPICOM_ENCODING_TYPE
     * @return string
     */
    public function SignCades(CPSigner $signer, int $cadesType, bool $detached, int $encodingType): string;

    /**
     * @param CPHashedData $hashedData
     * @param CPSigner $signer
     * @param int $cadesType CADESCOM_CADES_TYPE
     * @param int $encodingType CAPICOM_ENCODING_TYPE
     * @return string
     */
    public function SignHash(CPHashedData $hashedData, CPSigner $signer, int $cadesType, int $encodingType): string;

//    public function Sign();
//
//    public function CoSign();
//
//    public function CoSignCades();
//
//    public function CoSignHash();
//
//    public function EnhanceCades();
//
    /**
     * @param string $content
     * @param int $cadesType CADESCOM_CADES_TYPE
     * @param bool $detached
     * @return mixed
     */
    public function VerifyCades(string $content, int $cadesType, bool $detached);
//
//    public function VerifyHash();
//
    /**
     * @param string $content
     * @param bool $detached
     * @param int $verifyFlag CAPICOM_SIGNED_DATA_VERIFY_FLAG
     * @return mixed
     */
    public function Verify(string $content, bool $detached, int $verifyFlag);

    public function set_ContentEncoding(int $encoding): void;

    public function get_ContentEncoding(): int;

    public function set_Content(string $content): void;

    public function get_Content(): string;

    /**
     * @return ICPSigners
     */
    public function get_Signers();

    /**
     * @return ICPCertificates
     */
    public function get_Certificates();
}