<?php

namespace App\Libraries\CryptoPro\CLI\Requests;

use RuntimeException;

class SignRequest
{
    /**
     * @var string
     */
    public $inputFile;

    /**
     * @var string
     */
    public $outputFile;

    /**
     * @var bool
     */
    public $detached = true;

    /**
     * @var bool
     */
    public $noCert;

    /**
     * @var bool
     */
    public $noChain;

    /**
     * @var string
     */
    public $thumbprint;

    /**
     * @var string|null
     */
    public $pin;

    /**
     * @var string
     */
    public $userStore = 'My';

    public function validate(): void
    {
        if (!$this->inputFile) {
            throw new RuntimeException('Input file not defined');
        }

        if (!file_exists($this->inputFile)) {
            throw new RuntimeException('Input file not exists');
        }

        if (!$this->outputFile) {
            throw new RuntimeException('Output file not defined');
        }

        if (!$this->thumbprint) {
            throw new RuntimeException('Thumbprint not defined');
        }
    }

    public function serialize(): string
    {
        $args = [
            '-sign ' . $this->inputFile . ' ' . $this->outputFile,
            '-u' . $this->userStore,
            '-thumbprint \'' . $this->thumbprint . '\'',
            '-cadesbes'
        ];
        if ($this->detached) {
            $args[] = '-detached';
        }

        if ($this->noCert) {
            $args[] = '-nocert';
        }

        if ($this->noChain) {
            $args[] = '-nochain';
        }
        if ($this->pin) {
            $args[] = '-pin ' . $this->pin;
        }
        return implode(' ', $args);
    }

    /**
     * @param string $inputFile
     * @return SignRequest
     */
    public function setInputFile(string $inputFile): SignRequest
    {
        $this->inputFile = $inputFile;
        return $this;
    }

    /**
     * @param string $outputFile
     * @return SignRequest
     */
    public function setOutputFile(string $outputFile): SignRequest
    {
        $this->outputFile = $outputFile;
        return $this;
    }

    /**
     * @param bool $detached
     * @return SignRequest
     */
    public function setDetached(bool $detached): SignRequest
    {
        $this->detached = $detached;
        return $this;
    }

    /**
     * @param bool $noCert
     * @return SignRequest
     */
    public function setNoCert(bool $noCert): SignRequest
    {
        $this->noCert = $noCert;
        return $this;
    }

    /**
     * @param bool $noChain
     * @return SignRequest
     */
    public function setNoChain(bool $noChain): SignRequest
    {
        $this->noChain = $noChain;
        return $this;
    }

    /**
     * @param string $thumbprint
     * @return SignRequest
     */
    public function setThumbprint(string $thumbprint): SignRequest
    {
        $this->thumbprint = $thumbprint;
        return $this;
    }

    /**
     * @param string|null $pin
     * @return SignRequest
     */
    public function setPin(?string $pin): SignRequest
    {
        $this->pin = $pin;
        return $this;
    }

    /**
     * @param string $userStore
     * @return SignRequest
     */
    public function setUserStore(string $userStore): SignRequest
    {
        $this->userStore = $userStore;
        return $this;
    }
}