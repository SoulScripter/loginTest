<?php
declare(strict_types=1);

namespace App\Util\Validator;

interface ValidatorInterface
{
    public static function validate($subject);
}