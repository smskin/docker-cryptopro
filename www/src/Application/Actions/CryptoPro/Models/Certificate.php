<?php

namespace App\Application\Actions\CryptoPro\Models;

use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPCertificate;
use Exception;

/**
 * Class Certificate
 * @package App\Application\Actions\CryptoPro\Models
 *
 * @OA\Schema(
 *     title="Certificate",
 *     description="Certificate model",
 * )
 */
class Certificate
{
    /**
     * @var ICPCertificate
     */
    protected $context;

    /**
     * @var boolean
     *
     * @OA\Property()
     */
    public $hasPrivateKey;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $serialNumber;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $thumbprint;

    /**
     * @var Subject
     *
     * @OA\Property()
     */
    public $subject;

    /**
     * @var Subject
     *
     * @OA\Property()
     */
    public $issuer;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $validFrom;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $validTo;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $algo;

    /**
     * @var string
     *
     * @OA\Property()
     */
    public $algoName;

    /**
     * @var PrivateKey
     *
     * @OA\Property(ref="#/components/schemas/PrivateKey")
     */
    public $privateKey;

    /**
     * Certificate constructor.
     * @param ICPCertificate $certificate
     */
    public function __construct($certificate)
    {
        $this
            ->setContext($certificate)
            ->setHasPrivateKey($certificate->HasPrivateKey())
            ->setSerialNumber($certificate->get_SerialNumber())
            ->setThumbprint($certificate->get_Thumbprint())
            ->setSubject(
                new Subject($certificate->get_SubjectName())
            )
            ->setIssuer(
                new Subject($certificate->get_IssuerName())
            )
            ->setValidFrom($certificate->get_ValidFromDate())
            ->setValidTo($certificate->get_ValidToDate());

        try {
            $algo = $certificate->PublicKey()->get_Algorithm();
            $this
                ->setAlgo($algo->get_Value())
                ->setAlgoName($algo->get_FriendlyName());
        } catch (Exception $e) {
        }

        try {
            $this->setPrivateKey(
                new PrivateKey(
                    $certificate->PrivateKey()
                )
            );
        } catch (Exception $e) {
        }
    }

    /**
     * @param ICPCertificate $context
     * @return Certificate
     */
    public function setContext($context): Certificate
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @param bool $hasPrivateKey
     * @return Certificate
     */
    public function setHasPrivateKey(bool $hasPrivateKey): Certificate
    {
        $this->hasPrivateKey = $hasPrivateKey;
        return $this;
    }

    /**
     * @param string $serialNumber
     * @return Certificate
     */
    public function setSerialNumber(string $serialNumber): Certificate
    {
        $this->serialNumber = $serialNumber;
        return $this;
    }

    /**
     * @param string $thumbprint
     * @return Certificate
     */
    public function setThumbprint(string $thumbprint): Certificate
    {
        $this->thumbprint = $thumbprint;
        return $this;
    }

    /**
     * @param Subject $subject
     * @return Certificate
     */
    public function setSubject(Subject $subject): Certificate
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @param Subject $issuer
     * @return Certificate
     */
    public function setIssuer(Subject $issuer): Certificate
    {
        $this->issuer = $issuer;
        return $this;
    }

    /**
     * @param string $validFrom
     * @return Certificate
     */
    public function setValidFrom(string $validFrom): Certificate
    {
        $this->validFrom = $validFrom;
        return $this;
    }

    /**
     * @param string $validTo
     * @return Certificate
     */
    public function setValidTo(string $validTo): Certificate
    {
        $this->validTo = $validTo;
        return $this;
    }

    /**
     * @param string $algo
     * @return Certificate
     */
    public function setAlgo(string $algo): Certificate
    {
        $this->algo = $algo;
        return $this;
    }

    /**
     * @param string $algoName
     * @return Certificate
     */
    public function setAlgoName(string $algoName): Certificate
    {
        $this->algoName = $algoName;
        return $this;
    }

    /**
     * @param PrivateKey $privateKey
     * @return Certificate
     */
    public function setPrivateKey(PrivateKey $privateKey): Certificate
    {
        $this->privateKey = $privateKey;
        return $this;
    }
}