<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Database;


class SettingsService
{
  public function __construct(private Database $db) {}

  public function editIncomeCategory(array $formData)
  {
    
    $this->db->query(
      "UPDATE incomes_category_assigned_to_users
      SET
      name= :new_name
      WHERE user_id = :user_id AND name= :old_name",
      [
        'user_id' => $_SESSION['user'],
        'new_name' => $formData['new_income_name'],
        'old_name' => $formData['chosen_income_category']
      ]
    );
  }

  public function editExpenseCategory(array $formData)
  {
    
    $this->db->query(
      "UPDATE expenses_category_assigned_to_users
      SET
      name= :new_name
      WHERE user_id = :user_id AND name= :old_name",
      [
        'user_id' => $_SESSION['user'],
        'new_name' => $formData['new_expense_name'],
        'old_name' => $formData['chosen_expense_category']
      ]
    );
  }

  public function editPaymentMethod(array $formData)
  {
    
    $this->db->query(
      "UPDATE payment_methods_assigned_to_users
      SET
      name= :new_name
      WHERE user_id = :user_id AND name= :old_name",
      [
        'user_id' => $_SESSION['user'],
        'new_name' => $formData['new_payment_name'],
        'old_name' => $formData['chosen_payment_method']
      ]
    );
  }

  public function addIncomeCategory(array $formData)
  {
    
    $this->db->query(
      "INSERT INTO incomes_category_assigned_to_users VALUES(NULL, :user_id, :category_name)",           
      [
        'user_id' => $_SESSION['user'],
        'category_name' => $formData['new_income_name']        
      ]
    );
  }

  public function addExpenseCategory(array $formData)
  {
    
    $this->db->query(
      "INSERT INTO expenses_category_assigned_to_users VALUES(NULL, :user_id, :category_name)",           
      [
        'user_id' => $_SESSION['user'],
        'category_name' => $formData['new_expense_name']        
      ]
    );
  }

  public function addPaymentMethod(array $formData)
  {    
    $this->db->query(
      "INSERT INTO payment_methods_assigned_to_users VALUES(NULL, :user_id, :name)",           
      [
        'user_id' => $_SESSION['user'],
        'name' => $formData['new_payment_name']        
      ]
    );
  }


}