<?php

namespace App\Services;

use App\Libraries\CryptoPro\CAdESCOM\Constants\CADESCOM_CADES_TYPE;
use App\Libraries\CryptoPro\CAdESCOM\Constants\CADESCOM_CONTENT_ENCODING_TYPE;
use App\Libraries\CryptoPro\CAdESCOM\Constants\CAPICOM_ENCODING_TYPE;
use App\Libraries\CryptoPro\CAdESCOM\Constants\CAPICOM_SIGNED_DATA_VERIFY_FLAG;
use App\Libraries\CryptoPro\CAdESCOM\CPSignedData;
use App\Libraries\CryptoPro\CAdESCOM\CPSigner;
use App\Libraries\CryptoPro\CAdESCOM\Interfaces\ICPCertificate;
use App\Libraries\CryptoPro\CLI\CryptCP;
use App\Libraries\CryptoPro\CLI\Requests\SignRequest;
use Exception;
use Slim\Psr7\UploadedFile;

class CryptoPro
{
    /**
     * @param UploadedFile $file
     * @param ICPCertificate $certificate
     * @param string|null $pin
     * @param bool $noCert
     * @param bool $noChain
     * @return string
     * @throws Exception
     */
    public function sign(UploadedFile $file, $certificate, ?string $pin, bool $noCert, bool $noChain): string
    {
        // CAdESCOM is not support nocert and nochain flags
        if ($noCert || $noChain) {
            return $this->signViaCli(
                $file,
                $certificate,
                $pin,
                $noCert,
                $noChain
            );
        }

        return $this->signViaCAdESCOM(
            $file,
            $certificate,
            $pin
        );
    }

    public function verifySign(UploadedFile $file, UploadedFile $signature): bool
    {
        $sd = new CPSignedData();
        $sd->set_ContentEncoding(CADESCOM_CONTENT_ENCODING_TYPE::CADESCOM_BASE64_TO_BINARY);
        $sd->set_Content(base64_encode($file->getStream()->__toString()));
        try {
            $sd->VerifyCades(
                $signature->getStream()->__toString(),
                CADESCOM_CADES_TYPE::CADESCOM_CADES_BES,
                true
            );
        } catch (Exception $exception) {
            return false;
        }
        return true;
    }

    /**
     * @param UploadedFile $file
     * @param ICPCertificate $certificate
     * @param string|null $pin
     * @param bool $noCert
     * @param bool $noChain
     * @return string
     * @throws Exception
     */
    private function signViaCli(UploadedFile $file, $certificate, ?string $pin, bool $noCert, bool $noChain): string
    {
        $outputFile = tempnam(sys_get_temp_dir(), 'php');
        $request = (new SignRequest())
            ->setInputFile($file->getStream()->getMetadata('uri'))
            ->setOutputFile($outputFile)
            ->setThumbprint($certificate->get_Thumbprint())
            ->setPin($pin)
            ->setNoCert($noCert)
            ->setNoChain($noChain);
        (new CryptCP)->sign($request);
        $content = file_get_contents($outputFile);
        unlink($outputFile);
        return $content;
    }

    /**
     * @param UploadedFile $file
     * @param ICPCertificate $certificate
     * @param string|null $pin
     * @return string
     */
    private function signViaCAdESCOM(UploadedFile $file, $certificate, ?string $pin): string
    {
        $content = $file->getStream()->__toString();

        $signer = new CPSigner;
        $signer->set_Certificate($certificate);
        if ($pin) {
            $signer->set_KeyPin($pin);
        }

        $sd = new CPSignedData();
        $sd->set_ContentEncoding(CADESCOM_CONTENT_ENCODING_TYPE::CADESCOM_BASE64_TO_BINARY);
        $sd->set_Content(base64_encode($content));

        return $sd->SignCades(
            $signer,
            CADESCOM_CADES_TYPE::CADESCOM_CADES_BES,
            true,
            CAPICOM_ENCODING_TYPE::CAPICOM_ENCODE_BASE64
        );
    }
}