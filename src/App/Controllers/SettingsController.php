<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, SettingsService, TransactionService};


class SettingsController
{
  public function __construct(
    private TemplateEngine $view,
    private SettingsService $settingsService,
    private ValidatorService $validatorService,
    private TransactionService $transactionService
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
    redirectTo('/settings');
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
}
