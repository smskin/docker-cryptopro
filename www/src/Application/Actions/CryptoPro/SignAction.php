<?php


namespace App\Application\Actions\CryptoPro;

use App\Application\Actions\CryptoPro\Models\Certificate;
use App\Application\Actions\CryptoPro\Models\SignedFile;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPCertificate;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPCertificates;
use App\Services\CryptoPro;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class SignAction extends Action
{
    /**
     * @OA\Post(
     *     path="/crypto-pro/sign",
     *     summary="Sign file",
     *     @OA\RequestBody(
     *      required=true,
     *      @OA\MediaType(
     *          mediaType="multipart/form-data",
     *          @OA\Schema(
     *              @OA\Property(
     *                  description="Cert find type. In: thumbprint, subject",
     *                  property="findType",
     *                  type="string",
     *                  example="thumbprint"
     *              ),
     *              @OA\Property(
     *                  description="Cert find query",
     *                  property="query",
     *                  type="string",
     *                  example="2537152F88CD3964C6B64FEFE62735A0F4E2E6CD"
     *              ),
     *              @OA\Property(
     *                  description="Private key pin code",
     *                  property="pin",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  description="file to sign",
     *                  property="file",
     *                  type="file",
     *                  format="file",
     *              ),
     *              @OA\Property(
     *                  description="No cert flag. In: 0,1",
     *                  property="noCert",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  description="No chain flag. In: 0,1",
     *                  property="noChain",
     *                  type="string"
     *              ),
     *              required={"findType","query","file"}
     *          )
     *      )
     *     ),
     *     @OA\Response(
     *      response=200,
     *      description="successful operation",
     *      @OA\JsonContent(ref="#/components/schemas/SignedFile")
     *     )
     * )
     *
     * @return Response
     * @throws Exception
     */
    protected function action(): Response
    {
        $uploadedFiles = $this->request->getUploadedFiles();
        $input = $this->request->getParsedBody();
        $this->validateInput();

        $pin = null;
        if (array_key_exists('pin', $input)) {
            $pin = $input['pin'];
        }
        $noCert = false;
        if (array_key_exists('noCert', $input)) {
            $noCert = boolval($input['noCert']);
        }
        $noChain = false;
        if (array_key_exists('noChain', $input)) {
            $noChain = boolval($input['noChain']);
        }

        $cert = $this->getCertByQuery();
        if (!$cert) {
            throw new Exception('Certificate not exists');
        }

        $signedContent = (new CryptoPro())->sign(
            $uploadedFiles['file'],
            $cert,
            $pin,
            $noCert,
            $noChain
        );

        return $this->respondWithData(
            (new SignedFile)
                ->setSignedContent(trim(preg_replace('/\s\s+/', '', $signedContent)))
                ->setCert(
                    new Certificate($cert)
                )
        );
    }

    /**
     * @return ICPCertificate|null
     */
    private function getCertByQuery()
    {
        $input = $this->request->getParsedBody();
        $findType = null;
        switch ($input['findType']) {
            case 'thumbprint':
                $findType = ICPCertificates::CERTIFICATE_FIND_SHA1_HASH;
                break;
            case 'subject':
                $findType = ICPCertificates::CERTIFICATE_FIND_SUBJECT_NAME;
                break;
        }

        return $this->certificateRepository->find(
            $findType,
            $input['query']
        );
    }

    /**
     * @throws HttpBadRequestException
     */
    private function validateInput()
    {
        $uploadedFiles = $this->request->getUploadedFiles();
        $input = $this->request->getParsedBody();
        if (!$input) {
            $input = [];
        }

        if (!array_key_exists('file', $uploadedFiles) || $uploadedFiles['file']->getSize() === 0) {
            throw new HttpBadRequestException($this->request, 'File not defined');
        }

        if (!array_key_exists('findType', $input)) {
            throw new HttpBadRequestException($this->request, 'Find type not defined');
        }

        if (!in_array($input['findType'], [
            'thumbprint',
            'subject'
        ])) {
            throw new HttpBadRequestException($this->request, 'Find type not correct. Allowed: thumbprint, subject');
        }

        if (!array_key_exists('query', $input)) {
            throw new HttpBadRequestException($this->request, 'Query not defined');
        }
    }
}