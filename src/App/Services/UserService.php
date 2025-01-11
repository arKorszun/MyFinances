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

  }

  public function login(array $formData)
  {
    $user = $this->db->query("SELECT * FROM users WHERE email = :email", [
      'email' => $formData['email']
    ])->find();

    $passwordMatch = password_verify($formData['password'], $user['password'] ?? '');

    if(!$user || !$passwordMatch){
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
}
