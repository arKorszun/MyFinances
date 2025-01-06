<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\ValidatorService;

class AuthController
{
  

  public function __construct(private TemplateEngine $view, private ValidatorService $validatorService)
  {
    
  }
  public function registration()
  {
    echo $this->view->render("/registration.php", ['title' => 'Registration Page']);
  }

  public function register()
  {
    $this->validatorService->validateRegister($_POST);
  }
}