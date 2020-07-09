<?php


namespace App\Application\Actions\CryptoPro;

use App\Application\Actions\CryptoPro\Models\VerifyResponse;
use App\Services\CryptoPro;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class VerifySignAction extends Action
{
    /**
     * @OA\Post(
     *     path="/crypto-pro/verify-sign",
     *     summary="Verify signature",
     *     @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  description="Source file",
     *                  property="file",
     *                  type="file",
     *                  format="file",
     *              ),
     *              @OA\Property(
     *                  description="Signature file",
     *                  property="signature",
     *                  type="file",
     *                  format="file",
     *              ),
     *              required={"file","signature"}
     *          )
     *      )
     *     ),
     *     @OA\Response(
     *      response=200,
     *      description="successful operation",
     *      @OA\JsonContent(ref="#/components/schemas/VerifyResponse")
     *     )
     * )
     *
     * @return Response
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $uploadedFiles = $this->request->getUploadedFiles();
        $this->validateInput();

        return $this->respondWithData(
            (new VerifyResponse())
                ->setResult(
                    (new CryptoPro())->verifySign(
                        $uploadedFiles['file'],
                        $uploadedFiles['signature']
                    )
                )
        );
    }

    /**
     * @throws HttpBadRequestException
     */
    private function validateInput()
    {
        $uploadedFiles = $this->request->getUploadedFiles();
        if (!array_key_exists('file', $uploadedFiles) || $uploadedFiles['file']->getSize() === 0) {
            throw new HttpBadRequestException($this->request, 'File not defined');
        }

        if (!array_key_exists('signature', $uploadedFiles) || $uploadedFiles['signature']->getSize() === 0) {
            throw new HttpBadRequestException($this->request, 'Signature not defined');
        }

        $content = $uploadedFiles['signature']->getStream()->__toString();
        if (base64_decode($content, true) === false) {
            throw new HttpBadRequestException($this->request, 'Signature must be encoded to base64');
        }
    }
}