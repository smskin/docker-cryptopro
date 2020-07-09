<?php

namespace App\Application\Actions\CryptoPro\Models;

/**
 * Class SignedFile
 * @package App\Application\Actions\CryptoPro\Models
 *
 * @OA\Schema(
 *     title="SignedFile",
 *     description="Signed file model",
 * )
 */
class SignedFile
{
    /**
     * @var string
     *
     * @OA\Property()
     */
    public $signedContent;

    /**
     * @var Certificate
     *
     * @OA\Property(ref="#/components/schemas/Certificate")
     */
    public $cert;

    /**
     * @param string $signedContent
     * @return SignedFile
     */
    public function setSignedContent(string $signedContent): SignedFile
    {
        $this->signedContent = $signedContent;
        return $this;
    }

    /**
     * @param Certificate $cert
     * @return SignedFile
     */
    public function setCert(Certificate $cert): SignedFile
    {
        $this->cert = $cert;
        return $this;
    }
}