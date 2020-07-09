<?php

namespace App\Application\Actions\CryptoPro;

use App\Application\Actions\CryptoPro\Models\Certificate;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class ListCertificatesAction
 * @package App\Application\Actions\CryptoPro
 */
class ListCertificatesAction extends Action
{
    /**
     * @OA\Get(
     *     path="/crypto-pro/certificates",
     *     summary="Get list of certificates",
     *     @OA\Response(
     *      response=200,
     *      description="successful operation",
     *      @OA\Schema(
     *          type="array",
     *          @OA\Items(ref="#/components/schemas/Certificate")
     *      )
     *     )
     * )
     *
     * @return Response
     */
    protected function action(): Response
    {
        $certificates = $this->certificateRepository->all();
        $data = [];
        foreach ($certificates as $certificate) {
            $data[] = new Certificate($certificate);
        }

        return $this->respondWithData($data);
    }
}