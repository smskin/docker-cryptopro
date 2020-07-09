<?php
/** @noinspection PhpUndefinedClassInspection */

namespace App\Libraries\CryptoPro\CAdESCOM;

use App\Libraries\CryptoPro\CAdESCOM\Constants\CAPICOM_ENCODING_TYPE;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPCertificates;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPSignedData;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPSigners;

class CPSignedData extends \CPSignedData implements ICPSignedData
{
    /**
     * @param CPSigner $signer
     * @param int $cadesType CADESCOM_CADES_TYPE
     * @param bool $detached
     * @param int $encodingType CAPICOM_ENCODING_TYPE
     * @return string
     */
    public function SignCades(CPSigner $signer, int $cadesType, bool $detached = false, int $encodingType = CAPICOM_ENCODING_TYPE::CAPICOM_ENCODE_BASE64): string
    {
        return parent::SignCades($signer, $cadesType, $detached, $encodingType);
    }

    /**
     * @param CPHashedData $hashedData
     * @param CPSigner $signer
     * @param int $cadesType CADESCOM_CADES_TYPE
     * @param int $encodingType CAPICOM_ENCODING_TYPE
     * @return string
     */
    public function SignHash(CPHashedData $hashedData, CPSigner $signer, int $cadesType, int $encodingType): string
    {
        return parent::SignHash($hashedData, $signer, $cadesType, $encodingType);
    }

    /**
     * @param int $encoding CADESCOM_CONTENT_ENCODING_TYPE
     */
    public function set_ContentEncoding(int $encoding): void
    {
        parent::set_ContentEncoding($encoding);
    }

    public function get_ContentEncoding(): int
    {
        return parent::get_ContentEncoding();
    }

    public function set_Content(string $content): void
    {
        parent::set_Content($content);
    }

    public function get_Content(): string
    {
        return parent::get_Content();
    }

    /**
     * @return ICPSigners
     */
    public function get_Signers()
    {
        return parent::get_Signers();
    }

    /**
     * @return ICPCertificates
     */
    public function get_Certificates()
    {
        return parent::get_Certificates();
    }

    /**
     * @param string $content
     * @param int $cadesType CADESCOM_CADES_TYPE
     * @param bool $detached
     */
    public function VerifyCades(string $content, int $cadesType, bool $detached)
    {
        parent::VerifyCades($content, $cadesType, $detached);
    }

    /**
     * @param string $content
     * @param bool $detached
     * @param int $verifyFlag CAPICOM_SIGNED_DATA_VERIFY_FLAG
     * @return mixed
     */
    public function Verify(string $content, bool $detached, int $verifyFlag)
    {
        return parent::Verify($content, $detached, $verifyFlag);
    }
}