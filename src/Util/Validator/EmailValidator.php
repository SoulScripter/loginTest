<?php
declare(strict_types=1);

namespace App\Util\Validator;

class EmailValidator implements ValidatorInterface
{
    private static $EMAIL_SCHEMA = '~.*\@.*\..*~';

    /** @throws ValidatorException */
    public static function validate($subject): void
    {
        if(!is_string($subject)){
            throw new ValidatorException('Invalid subject');
        }

        if(!preg_match(self::$EMAIL_SCHEMA, $subject)){
            throw new ValidatorException('Email does not match the schema');
        }
    }
}