<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator.
 *
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'cpf'           => 'required|string|size:11',
            'name'          => 'required',
            'phone'         => 'required',
            'email'         => 'required|unique:users,email',
            // 'birth'         => '',
            // 'gender'        => '',
            // 'notes'         => '',
            // 'password'      => '',
            // 'status'        => '',
            // 'permission'    => ''
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
