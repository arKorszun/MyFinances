<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, UserService};

class AuthController
{


  public function __construct(
    private TemplateEngine $view,
    private ValidatorService $validatorService,
    private UserService $userService
  ) {}
  
  public function registration()
  {
    echo $this->view->render("/registration.php");
  }

  public function register()
  {
    $this->validatorService->validateRegister($_POST);

    $this->userService->isEmailTaken($_POST['email']);

    $this->userService->create($_POST);

    redirectTo('/welcome');
  }

  public function loginView()
  {
    echo $this->view->render("/login.php");
  }

  public function login()
  {
    $this->validatorService->validateLogin($_POST);

    $this->userService->login($_POST);

    redirectTo('/welcome');
  }

  public function logout()
  {
    $this->userService->logout();

    redirectTo('/');
  }
}
