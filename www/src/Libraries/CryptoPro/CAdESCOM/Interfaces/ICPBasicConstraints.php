<?php

namespace App\Libraries\CryptoPro\CAdESCOM\Interfaces;

interface ICPBasicConstraints
{
    public function set_IsPresent();

    public function get_IsPresent();

    public function set_IsCritical();

    public function get_IsCritical();

    public function get_IsCertificateAuthority();

    public function get_IsPathLenConstraintPresent();

    public function get_PathLenConstraint();
}