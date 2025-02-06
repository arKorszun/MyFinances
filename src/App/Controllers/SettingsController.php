<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, SettingsService, TransactionService, UserService};
use Framework\Exceptions\ValidationException;


class SettingsController
{
  public function __construct(
    private TemplateEngine $view,
    private SettingsService $settingsService,
    private ValidatorService $validatorService,
    private TransactionService $transactionService,
    private UserService $userService
  ) {}



  public function settingsView()
  {
    $incomeCategories = $this->transactionService->getUserIncomesCategories();
    $expenseCategories = $this->transactionService->getUserExpensesCategories();
    $paymentMethods = $this->transactionService->getUserPaymentMethods();

    echo $this->view->render("/settings.php", [
      'incomeCategories' => $incomeCategories,
      'expenseCategories' => $expenseCategories,
      'paymentMethods' => $paymentMethods
    ]);
  }

  public function editIncomeCategory()
  {
    $this->validatorService->validateIncomeCategory($_GET);
    $this->settingsService->editIncomeCategory($_GET);
    unset($_GET);
    redirectTo($_SERVER['HTTP_REFERER']);
  }

  public function editExpenseCategory()
  {
    $this->validatorService->validateExpenseCategory($_GET);
    $this->settingsService->editExpenseCategory($_GET);
    unset($_GET);
    redirectTo('/settings');
  }

  public function editPaymentMethod()
  {
    $this->validatorService->validatePaymentMethod($_GET);
    $this->settingsService->editPaymentMethod($_GET);
    unset($_GET);
    redirectTo('/settings');
  }

  public function addIncomeCategory()
  {
    $this->validatorService->validateIncomeCategory($_GET);
    $this->settingsService->addIncomeCategory($_GET);
    unset($_GET);
    redirectTo('/settings');
  }

  public function addExpenseCategory()
  {
    $this->validatorService->validateExpenseCategory($_GET);
    $this->settingsService->addExpenseCategory($_GET);
    unset($_GET);
    redirectTo('/settings');
  }

  public function addPaymentMethod()
  {
    $this->validatorService->validatePaymentMethod($_GET);

    $this->settingsService->addPaymentMethod($_GET);
    unset($_GET);
    redirectTo('/settings');
  }

  public function deleteIncomeCategory()
  {
    $this->settingsService->deleteIncomeCategory($_GET);
    unset($_GET);
    redirectTo('/settings');
  }

  public function deleteExpenseCategory()
  {
    $this->settingsService->deleteExpenseCategory($_GET);
    unset($_GET);
    redirectTo('/settings');
  }

  public function deletePaymentMethod()
  {
    $this->settingsService->deletePaymentMethod($_GET);
    unset($_GET);
    redirectTo('/settings');
  }

  public function editUserDataView()
  {
    $userData = $this->settingsService->getUserData();

    echo $this->view->render(
      "/editUserData.php",
      [
        'userData' => $userData
      ]
    );
  }

  public function editUserData()
  {

    $actualUserData = $this->settingsService->getUserData();
    $newUserData = [];

    if ($actualUserData['username'] != $_POST['username']) {
      $this->validatorService->validateUsername($_POST);
      $newUserData['username'] = $_POST['username'];
    } else {
      $newUserData['username'] =  $actualUserData['username'];
    }



    if ($actualUserData['email'] != $_POST['email']) {
      $this->validatorService->validateEmail($_POST);
      $this->userService->isEmailTaken($_POST['email']);
      $newUserData['email'] = $_POST['email'];
    } else {
      $newUserData['email'] =  $actualUserData['email'];
    }


    if ((!empty($_POST['password'])) ||  (!empty($_POST['password2']))) {
      $this->validatorService->validatePassword($_POST);
      $newUserData['password'] = $_POST['password'];
      $newUserData['password'] = password_hash($newUserData['password'], PASSWORD_BCRYPT, ['cost' => 12]);
    } else {
      $newUserData['password'] =  $actualUserData['password'];
    }

    $this->settingsService->editUserData($newUserData);
    redirectTo('/settings');
  }

  public function deleteAllUserData()
  {
    $userData = $this->settingsService->getUserData();

    $passwordMatch = password_verify($_GET['typed_password'], $userData['password'] ?? '');

    if (!$passwordMatch) {
      throw new ValidationException(['password' => ['Nieprawidłowe hasło!']]);
      dd($errors['password'][0]);
    } else {
      $this->settingsService->deleteAllUserData();
      $this->userService->logout();
    }
  }
}
