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
    echo $this->view->render("transactions/addExpense.php", [
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

  public function editIncomeView(array $params)
  {
    $income = $this->transactionService->getUserIncome(
      $params['income']
    );

    $incomesCategories = $this->transactionService->getUserIncomesCategories();

    if (!$income) {
      redirectTo('/welcome');
    }

    echo $this->view->render('transactions/editIncome.php', [
      'income' => $income,
      'incomesCategories' => $incomesCategories
    ]);
  }

  public function editIncome(array $params)
  {
    $income = $this->transactionService->getUserIncome(
      $params['income']
    );

    if (!$income) {
      redirectTo('/welcome');
    }

    $incomesCategories = $this->transactionService->getIncomesCatArray();

    $this->validatorService->validateIncome($_POST, $incomesCategories);

    $this->transactionService->updateIncome($_POST, $income['id']);

    redirectTo('/balance');
  }

  public function editExpenseView(array $params)
  {
    $expense = $this->transactionService->getUserExpense(
      $params['expense']
    );

    $expensesCategories = $this->transactionService->getUserExpensesCategories();
    $paymentMethods = $this->transactionService->getUserPaymentMethods();

    if (!$expense) {
      redirectTo('/welcome');
    }

    echo $this->view->render('transactions/editExpense.php', [
      'expense' => $expense,
      'expensesCategories' => $expensesCategories,
      'paymentMethods' => $paymentMethods
    ]);
  }

  public function editExpense(array $params)
  {
    $expense = $this->transactionService->getUserExpense(
      $params['expense']
    );
    
    if (!$expense) {
      redirectTo('/welcome');
    }

    $expensesCategories = $this->transactionService->getExpensesCatArray();
    $paymentMethods = $this->transactionService->getPaymentMetArray();

    //dd($expensesCategories);

    $this->validatorService->validateExpense($_POST, $expensesCategories, $paymentMethods);

    $this->transactionService->updateExpense($_POST, $expense['id']);

    redirectTo('/balance');

  }

  public function deleteIncome(array $params)
  {
    $this->transactionService->deleteIncome((int) $params['income']);
    redirectTo('/balance');
  }

  public function deleteExpense(array $params)
  {
    $this->transactionService->deleteExpense((int) $params['expense']);
    redirectTo('/balance');
  }
}
