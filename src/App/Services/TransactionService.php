<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;


class TransactionService
{
  public function __construct(private Database $db) {}

  private function getExpenseCategoryId(array $formData)
  {
    $logged_user_id = $_SESSION['user'];
    $expense_category = $formData['expense_category'];      

    $expenseCategoryId = $this->db->query(
      "SELECT id FROM expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.user_id = :logged_user_id AND expenses_category_assigned_to_users.name = :expense_category",
      [
        'logged_user_id' => $logged_user_id,
        'expense_category' => $expense_category
      ]
    )->find();
    
    return $expenseCategoryId['id'];
  }

  private function getPaymentMethodId(array $formData)
  {
    $logged_user_id = $_SESSION['user'];
    $payment_method = $formData['payment_method'];

    $paymentMethodId = $this->db->query(
      "SELECT id FROM payment_methods_assigned_to_users WHERE payment_methods_assigned_to_users.user_id = :logged_user_id AND payment_methods_assigned_to_users.name = :payment_method",
      [
        'logged_user_id' => $logged_user_id,
        'payment_method' => $payment_method
      ]
    )->find();
    
    return $paymentMethodId['id'];
  }

  public function addExpense(array $formData)
  {
    $expense_category_id = $this->getExpenseCategoryId($formData);

    $payment_method_id = $this->getPaymentMethodId($formData);

    $this->db->query(
      "INSERT INTO expenses VALUES(NULL,:user_id, :expense_category_id, :payment_method_id, :expense_amount, :expense_date, :expense_comment)",
      [
        'user_id' => $_SESSION['user'],
        'expense_category_id' => $expense_category_id,
        'payment_method_id' => $payment_method_id,
        'expense_amount' => $formData['expense_amount'],
        'expense_date' => $formData['expense_date'],
        'expense_comment' => $formData['expense_comment']

      ]
    );
    $_SESSION['succesAdd'] = true;
  }

  private function getIncomeCategoryId(array $formData)
  {
    $logged_user_id = $_SESSION['user'];
    $income_category = $formData['income_category'];      

    $incomeCategoryId = $this->db->query(
      "SELECT id FROM incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.user_id = :logged_user_id AND incomes_category_assigned_to_users.name = :income_category",
      [
        'logged_user_id' => $logged_user_id,
        'income_category' => $income_category
      ]
    )->find();
    
    return $incomeCategoryId['id'];
  }

  public function addIncome(array $formData)
  {
    $income_category_id = $this->getIncomeCategoryId($formData);
   
    $this->db->query(
      "INSERT INTO incomes VALUES(NULL, :user_id, :income_category_id, :income_amount, :income_date, :income_comment)",
      [
        'user_id' => $_SESSION['user'],
        'income_category_id' => $income_category_id,    
        'income_amount' => $formData['income_amount'],
        'income_date' => $formData['income_date'],
        'income_comment' => $formData['income_comment']

      ]
    );
    $_SESSION['succesAdd'] = true;
  }

  public function getUserExpenses()
  {
    $expenses = $this->db->query(
      "",[]
    );
  }
}
