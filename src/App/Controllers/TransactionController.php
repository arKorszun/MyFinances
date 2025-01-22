<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{ValidatorService, TransactionService};

class TransactionController
{
  public function __construct(
    private TemplateEngine $view,
    private ValidatorService $validatorService,
    private TransactionService $transactionService,

  ) {}

  public function addExpenseView()
  {
    $expensesAttributes = $this->transactionService->getUserExpensesAttributes();
    echo $this->view->render("transactions/addExpense.php",[
      'expensesAttributes' => $expensesAttributes
    ]);
  }

  public function addExpense()
  {   
    $expensesCategories = $this->transactionService->getExpensesCatArray();    
    $paymentMethods = $this->transactionService->getPaymentMetArray();
   
    $this->validatorService->validateExpense($_POST, $expensesCategories, $paymentMethods);

    $this->transactionService->addExpense($_POST);

    redirectTo('/welcome');
  }
  public function addIncomeView()
  {
    $incomesCategories = $this->transactionService->getUserIncomesCategories();
    echo $this->view->render("transactions/addIncome.php", [
      'incomesCategories' => $incomesCategories
    ]);
  }

  public function addIncome()
  {
    $incomesCategories = $this->transactionService->getIncomesCatArray();     
    
    $this->validatorService->validateIncome($_POST, $incomesCategories);

    $this->transactionService->addIncome($_POST);

    redirectTo('/welcome');
  }

  public function balanceView()
  {
    //$this->validatorService->validateBalanceDates($_POST);
    $transactions = $this->getUserTransactions();
    echo $this->view->render("transactions/balance.php", [
      'transactions' => $transactions
    ]);    
  }

  public function getUserTransactions()
  {
    $dates = $this->transactionService->getBalancePeriod();
    $expenses = $this->transactionService->getUserExpenses($dates);
    $incomes = $this->transactionService->getUserIncomes($dates);
    $incomesCatSum = $this->transactionService->getUserIncomesCatSum($dates);
    $expensesCatSum = $this->transactionService->getUserExpensesCatSum($dates);
    $transactions = [
      'incomes' => $incomes,
      'expenses' => $expenses,
      'incomesCatSum' => $incomesCatSum,
      'expensesCatSum' => $expensesCatSum
    ];

    return $transactions;
  }
}
