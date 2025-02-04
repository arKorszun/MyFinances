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

  public function getBalancePeriod()
  {
    if (isset($_GET['previous_month'])) {
      $year = date("Y");
      $month = date("m") - 1;

      if ($month < 1) {
        $month = 12;
        $year -= 1;
      }

      $day =  date("t", mktime(0, 0, 0, (int) $month, 1, (int) $year));

      $end_date = date("$year-$month-$day");
      $start_date = date("$year-$month-01");
    } else if (isset($_GET['current_year'])) {

      $end_date = date("Y-m-d");
      $start_date = date("Y-01-01");
    } else if (isset($_GET['custom_period'])) {

      $end_date = $_GET['custom_date_end'];
      $start_date = $_GET['custom_date_start'];
    } else {
      $end_date = date("Y-m-d");
      $start_date = date("Y-m-01");
    }
    $dates = [$start_date, $end_date];
    unset($_GET['current_month']);
    unset($_GET['current_year']);
    unset($_GET['previous_month']);

    return $dates;
  }

  public function getUserExpenses(array $dates)
  {
    $start_date = $dates['0'];
    $end_date = $dates['1'];

    $expenses = $this->db->query(
      "SELECT expenses.id, expenses.amount, expenses.date_of_expense, expenses.expense_comment , expenses_category_assigned_to_users.name AS expense_category_name, payment_methods_assigned_to_users.name AS payment_method 
      FROM expenses 
      INNER JOIN expenses_category_assigned_to_users ON expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id
      INNER JOIN payment_methods_assigned_to_users ON payment_methods_assigned_to_users.id=expenses.payment_method_assigned_to_user_id 
      WHERE expenses.user_id = :user_id AND expenses.date_of_expense BETWEEN :start_date AND :end_date 
      ORDER BY expenses.date_of_expense DESC ",
      [
        'user_id' => $_SESSION['user'],
        'start_date' => $start_date,
        'end_date' => $end_date
      ]
    )->findAll();

    return $expenses;
  }

  public function getUserIncomes(array $dates)
  {
    $start_date = $dates['0'];
    $end_date = $dates['1'];

    $incomes = $this->db->query(
      "SELECT incomes.id, incomes.amount, incomes.date_of_income, incomes.income_comment , incomes_category_assigned_to_users.name AS category_name
      FROM incomes 
      INNER JOIN incomes_category_assigned_to_users ON incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id
      WHERE incomes.user_id = :user_id AND incomes.date_of_income BETWEEN :start_date AND :end_date 
      ORDER BY incomes.date_of_income DESC ",
      [
        'user_id' => $_SESSION['user'],
        'start_date' => $start_date,
        'end_date' => $end_date
      ]
    )->findAll();

    return $incomes;
  }

  public function getUserIncomesCatSum(array $dates)
  {
    $start_date = $dates['0'];
    $end_date = $dates['1'];

    $incomesCatSum = $this->db->query(
      "SELECT incomes_category_assigned_to_users.name, SUM(incomes.amount) AS category_sum FROM incomes_category_assigned_to_users INNER JOIN incomes ON incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id WHERE incomes.user_id = :user_id AND incomes.date_of_income BETWEEN :start_date AND :end_date GROUP BY incomes_category_assigned_to_users.name ORDER BY category_sum DESC",
      [
        'user_id' => $_SESSION['user'],
        'start_date' => $start_date,
        'end_date' => $end_date
      ]
    )->findAll();

    return $incomesCatSum;
  }

  public function getUserExpensesCatSum(array $dates)
  {
    $start_date = $dates['0'];
    $end_date = $dates['1'];

    $expensesCatSum = $this->db->query(
      "SELECT expenses_category_assigned_to_users.name, SUM(expenses.amount) AS category_sum FROM expenses_category_assigned_to_users INNER JOIN expenses ON expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id WHERE expenses.user_id = :user_id AND expenses.date_of_expense BETWEEN :start_date AND :end_date GROUP BY expenses_category_assigned_to_users.name ORDER BY category_sum DESC",
      [
        'user_id' => $_SESSION['user'],
        'start_date' => $start_date,
        'end_date' => $end_date
      ]
    )->findAll();

    return $expensesCatSum;
  }

  public function getUserIncomesCategories()
  {
    $incomesCategories = $this->db->query(
      "SELECT incomes_category_assigned_to_users.name AS category_name, id  FROM incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.user_id = :user_id",
      [
        'user_id' => $_SESSION['user'],
      ]
    )->findAll();

    return $incomesCategories;
  }

  public function getIncomesCatArray()
  {
    $incomesCategoriesAssoc = $this->getUserIncomesCategories();
    $incomesCategories = [];
    foreach ($incomesCategoriesAssoc as $category) {
      array_push($incomesCategories, $category['category_name']);
    }
    return $incomesCategories;
  }

  public function getUserExpensesCategories()
  {
    $expensesCategories = $this->db->query(
      "SELECT expenses_category_assigned_to_users.name AS category_name  FROM expenses_category_assigned_to_users WHERE expenses_category_assigned_to_users.user_id = :user_id",
      [
        'user_id' => $_SESSION['user'],
      ]
    )->findAll();

    return $expensesCategories;
  }

  public function getExpensesCatArray()
  {
    $expensesCategoriesAssoc = $this->getUserExpensesCategories();
    $expensesCategories = [];
    foreach ($expensesCategoriesAssoc as $category) {
      array_push($expensesCategories, $category['category_name']);
    }

    return $expensesCategories;
  }

  public function getUserPaymentMethods()
  {
    $paymentMethods = $this->db->query(
      "SELECT payment_methods_assigned_to_users.name AS payment_methode  FROM payment_methods_assigned_to_users WHERE payment_methods_assigned_to_users.user_id = :user_id",
      [
        'user_id' => $_SESSION['user'],
      ]
    )->findAll();

    return $paymentMethods;
  }

  public function getPaymentMetArray()
  {
    $paymentMethodsAssoc = $this->getUserPaymentMethods();
    $paymentMethods = [];
    foreach ($paymentMethodsAssoc as $method) {
      array_push($paymentMethods, $method['payment_methode']);
    }

    return $paymentMethods;
  }

  public function getUserExpensesAttributes()
  {
    $expensesCategories = $this->getUserExpensesCategories();
    $paymentMethods = $this->getUserPaymentMethods();
    $expensesAttributes = [
      'expensesCategories' => $expensesCategories,
      'paymentMethods' => $paymentMethods
    ];
    return $expensesAttributes;
  }

  public function getUserIncome(string $id)
  {
    return $this->db->query(
      "SELECT incomes.id, incomes.amount, DATE_FORMAT(date_of_income, '%Y-%m-%d') AS formatted_date, incomes_category_assigned_to_users.name, incomes.income_comment 
      FROM incomes 
      INNER JOIN incomes_category_assigned_to_users ON incomes_category_assigned_to_users.id = incomes.income_category_assigned_to_user_id
      WHERE incomes.id = :id AND incomes.user_id = :user_id",
      [
        'id' => $id,
        'user_id' => $_SESSION['user']
      ]

      )->find();
  }

  public function updateIncome(array $formData, int $id)
  {
    $income_category_id = $this->getIncomeCategoryId($formData);
    

    $this->db->query(
      "UPDATE incomes
      SET           
      income_category_assigned_to_user_id = :income_category_id,
      amount = :income_amount,
      date_of_income = :income_date,
      income_comment = :income_comment
      WHERE id = :id AND user_id =:user_id",
      [
        'id' => $id,
        'user_id' => $_SESSION['user'],
        'income_category_id' => $income_category_id,
        'income_amount' => $formData['income_amount'],
        'income_date' => $formData['income_date'],
        'income_comment' => $formData['income_comment']        
      ]
      
      );
  }

  public function getUserExpense(string $id)
  {
    return $this->db->query(
      "SELECT expenses.id, expenses.amount, DATE_FORMAT(date_of_expense, '%Y-%m-%d') AS formatted_date, expenses_category_assigned_to_users.name AS expense_category, payment_methods_assigned_to_users.name AS payment_method, expenses.expense_comment
      FROM expenses 
      INNER JOIN expenses_category_assigned_to_users ON expenses_category_assigned_to_users.id = expenses.expense_category_assigned_to_user_id
      INNER JOIN payment_methods_assigned_to_users ON payment_methods_assigned_to_users.id = expenses.payment_method_assigned_to_user_id
      WHERE expenses.id = :id AND expenses.user_id = :user_id",
      [
        'id' => $id,
        'user_id' => $_SESSION['user']
      ]

      )->find();
  }

  public function updateExpense(array $formData, int $id)
  {
    $expense_category_id = $this->getExpenseCategoryId($formData);

    $payment_method_id = $this->getPaymentMethodId($formData);

    $this->db->query(
      "UPDATE expenses
      SET
      expense_category_assigned_to_user_id = :expense_category_id,
      payment_method_assigned_to_user_id = :payment_method_id,
      amount = :expense_amount,
      date_of_expense = :expense_date,
      expense_comment = :expense_comment
      WHERE id = :id AND user_id = :user_id",
      [
        'id' => $id,
        'user_id' => $_SESSION['user'],
        'expense_category_id' => $expense_category_id,
        'payment_method_id' => $payment_method_id,
        'expense_amount' => $formData['expense_amount'],
        'expense_date' => $formData['expense_date'],
        'expense_comment' => $formData['expense_comment']
      ]
      );
  }

  public function deleteIncome(int $id)
  {
    $this->db->query(
      "DELETE FROM incomes WHERE id = :id AND user_id = :user_id",
      [
        'id' => $id,
        'user_id' => $_SESSION['user']
      ]
      );
  }

  public function deleteExpense(int $id)
  {
    $this->db->query(
      "DELETE FROM expenses WHERE id = :id AND user_id = :user_id",
      [
        'id' => $id,
        'user_id' => $_SESSION['user']
      ]
      );
  }
}
