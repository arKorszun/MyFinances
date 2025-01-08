<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};

class AuthController
{
  

  public function __construct(private TemplateEngine $view, private ValidatorService $validatorService, private UserService $userService)
  {
    
  }
  public function registration()
  {
    echo $this->view->render("/registration.php", ['title' => 'Registration Page']);
  }

  public function register()
  {
    $this->validatorService->validateRegister($_POST);

    $this->userService->isEmailTaken($_POST['email']);

    $this->userService->create($_POST);

    redirectTo('/');
  }

  public function loginView()
  {
    echo $this->view->render("/login.php", ['title' => 'Login Page']);
  }
}