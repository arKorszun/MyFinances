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
    echo $this->view->render("transactions/addExpense.php");
  }

  public function addExpense()
  {
    $this->validatorService->validateExpense($_POST);

    $this->transactionService->addExpense($_POST);
    
    redirectTo('/welcome');
  }
  public function addIncomeView()
  {
    echo $this->view->render("transactions/addIncome.php");
  }

  public function addIncome()
  {
    $this->validatorService->validateIncome($_POST);

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
    $expenses = $this->transactionService->getUserExpenses($_POST);
    $incomes = $this->transactionService->getUserIncomes($_POST);
    $incomesCatSum = $this->transactionService->getUserIncomesCatSum($_POST);
    $expensesCatSum = $this->transactionService->getUserExpensesCatSum($_POST);
    $transactions = [
      'incomes' => $incomes,
      'expenses' => $expenses,
      'incomesCatSum' => $incomesCatSum,
      'expensesCatSum' => $expensesCatSum
    ];
    
    return $transactions;
  }

}
