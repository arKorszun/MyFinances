<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;
use Framework\Exceptions\ValidationException;

class UserService
{
  public function __construct(private Database $db) {}

  public function isEmailTaken(string $email)
  {
    $emailCount = $this->db->query(
      "SELECT COUNT(*) FROM users WHERE email = :email",
      [
        'email' => $email
      ]
    )->count();

    if ($emailCount > 0) {
      throw new ValidationException(['email' => 'Podany email jest już zajęty']);
    }
  }

  public function create(array $formData)
  {

    $password = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);

    $this->db->query(
      "INSERT INTO users VALUES(NULL, :username, :password, :email)",
      [
        'username' => $formData['username'],
        'password' => $password,
        'email' => $formData['email']
      ]
    );

    session_regenerate_id();

    $_SESSION['user'] = $this->db->id();
    $_SESSION['username'] = $formData['username'];
    $_SESSION['loginInfo'] = true;

    $this->addDefaultCategories();
  }

  public function login(array $formData)
  {
    $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
      'email' => $formData['email']
    ])->find();

    $passwordMatch = password_verify($formData['password'], $user['password'] ?? '');

    if (!$user || !$passwordMatch) {
      throw new ValidationException(['password' => ['Nieprawidłowe dane logowania']]);
    }

    session_regenerate_id();

    $_SESSION['user'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['loginInfo'] = true;
  }

  public function logout()
  {
    unset($_SESSION['user']);

    session_regenerate_id();
  }

  public function addDefaultCategories()
  {
    $defIncomes = $this->getDefaultIncomeCategories();
    $defExpenses = $this->getDefaultExpenseCategories();
    $defPaymenMet = $this->getDefaultPaymentMethodes();

    foreach ($defIncomes as $inc) {
      $this->db->query(
        "INSERT INTO incomes_category_assigned_to_users VALUES(NULL, :user_id, :name)",
        [
          'user_id' => $_SESSION['user'],
          'name' => $inc['name']
        ]
      );
    }

    foreach ($defExpenses as $exp) {
      $this->db->query(
        "INSERT INTO expenses_category_assigned_to_users VALUES(NULL, :user_id, :name)",
        [
          'user_id' => $_SESSION['user'],
          'name' => $exp['name']
        ]
      );
    }

    foreach ($defPaymenMet as $pay) {
      $this->db->query(
        "INSERT INTO payment_methods_assigned_to_users VALUES(NULL, :user_id, :name)",
        [
          'user_id' => $_SESSION['user'],
          'name' => $pay['name']
        ]
      );
    }
  }

  public function getDefaultIncomeCategories()
  {
    return $this->db->query(
      "SELECT name FROM incomes_category_default"
    )->findAll();
  }

  public function getDefaultExpenseCategories()
  {
    return $this->db->query(
      "SELECT name FROM expenses_category_default"
    )->findAll();
  }

  public function getDefaultPaymentMethodes()
  {
    return $this->db->query(
      "SELECT name FROM payment_methods_default"
    )->findAll();
  }
}
