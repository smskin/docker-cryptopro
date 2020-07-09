<?php

namespace App\Application\Actions\CryptoPro\Models;

/**
 * Class VerifyResponse
 * @package App\Application\Actions\CryptoPro\Models
 *
 * @OA\Schema(
 *     title="VerifyResponse",
 *     description="Verify response model",
 * )
 */
class VerifyResponse
{
    /**
     * @var bool
     *
     * @OA\Property()
     */
    public $result;

    /**
     * @param bool $result
     * @return VerifyResponse
     */
    public function setResult(bool $result): VerifyResponse
    {
        $this->result = $result;
        return $this;
    }
}