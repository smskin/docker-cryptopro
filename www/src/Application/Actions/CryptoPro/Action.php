<?php

namespace App\Application\Actions\CryptoPro;

use App\Application\Actions\Action as BaseAction;
use App\Domain\CryptoPro\CertificateRepository;
use Psr\Log\LoggerInterface;

abstract class Action extends BaseAction
{
    /**
     * @var CertificateRepository
     */
    protected $certificateRepository;

    /**
     * @param LoggerInterface $logger
     * @param CertificateRepository $certificateRepository
     */
    public function __construct(LoggerInterface $logger, CertificateRepository $certificateRepository)
    {
        parent::__construct($logger);
        $this->certificateRepository = $certificateRepository;
    }
}