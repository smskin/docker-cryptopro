<?php
/** @noinspection PhpUndefinedClassInspection */

namespace App\Libraries\CryptoPro\CAdESCOM;

use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPAttributes;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPCertificate;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPSigner;

class CPSigner extends \CPSigner implements ICPSigner
{
    /**
     * @return ICPCertificate
     */
    public function get_Certificate()
    {
        return parent::get_Certificate();
    }

    /**
     * @param ICPCertificate $certificate
     */
    public function set_Certificate($certificate): void
    {
        parent::set_Certificate($certificate);
    }

    public function get_Options(): int
    {
        return parent::get_Options();
    }

    public function set_Options(int $option): void
    {
        parent::set_Options($option);
    }

    /**
     * @return ICPAttributes
     */
    public function get_AuthenticatedAttributes()
    {
        return parent::get_AuthenticatedAttributes();
    }

    /**
     * @return ICPAttributes
     */
    public function get_UnauthenticatedAttributes()
    {
        return parent::get_UnauthenticatedAttributes();
    }

    public function get_TSAAddress(): string
    {
        return parent::get_TSAAddress();
    }

    public function set_TSAAddress(string $address): void
    {
        parent::set_TSAAddress($address);
    }

    public function get_CRLs(): array
    {
        return parent::get_CRLs();
    }

    public function get_OCSPResponses(): array
    {
        return parent::get_OCSPResponses();
    }

    public function set_KeyPin(string $pin): void
    {
        parent::set_KeyPin($pin);
    }
}