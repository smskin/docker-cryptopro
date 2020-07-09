<?php

namespace App\Libraries\CryptoPro\CLI\Responses;

class CliResponse
{
    /**
     * @var string
     */
    public $message;

    /**
     * @param string $message
     * @return CliResponse
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }
}