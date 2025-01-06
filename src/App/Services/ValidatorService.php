<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{RequiredRule, EmailRule, MinRule, MatchRule, LengthRule, AlfanumericRule};

class ValidatorService
{
  private Validator $validator;

  public function __construct()
  {
    $this->validator = new Validator();

    $this->validator->add('required', new RequiredRule());
    $this->validator->add('email', new EmailRule());
    $this->validator->add('match', new MatchRule());
    $this->validator->add('length', new LengthRule());
    $this->validator->add('alfanum', new AlfanumericRule());
    //$this->validator->add('min', new MinRule());
  }

  public function validateRegister(array $formData)
  {
    $this->validator->validate($formData, [
      'username' => ['required', 'length:2,20', 'alfanum'],
      'email' => ['required', 'email'],
      'password' => ['required'],
      'password2' => ['required', 'match:password']  
    ]);
  }
}