<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
  RequiredRule,
  EmailRule,
  MinRule,
  MatchRule,
  LengthRule,
  LengthMaxRule,
  AlfanumericRule,
  InRule,
  NumericRule,
  DateFormatRule,
  DateRangeMaxRule,
  EndStartDateRule
};

class ValidatorService
{
  private Validator $validator;

  public function __construct()
  {
    $this->validator = new Validator();

    $this->validator->add('required', new RequiredRule());
    $this->validator->add('email', new EmailRule());
    $this->validator->add('match', new MatchRule());
    $this->validator->add('in', new InRule());
    $this->validator->add('length', new LengthRule());
    $this->validator->add('lengthMax', new LengthMaxRule());
    $this->validator->add('alfanum', new AlfanumericRule());
    $this->validator->add('numeric', new NumericRule());
    $this->validator->add('dateFormat', new DateFormatRule());
    //$this->validator->add('dateMax', new DateRangeMaxRule());
    //$this->validator->add('dateRange', new EndStartDateRule());
    //$this->validator->add('min', new MinRule());
  }

  public function validateRegister(array $formData)
  {
    $this->validator->validate($formData, [
      'username' => ['required', 'length:2,20', 'alfanum'],
      'email' => ['required', 'email'],
      'password' => ['required'],
      'password2' => ['required', 'match:password']
    ]);
  }

  public function validateLogin(array $formData)
  {
    $this->validator->validate($formData, [
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);
  }

  public function validateExpense(array $formData, array $expensesCategories, array $paymentMethods)
  {
    
    $categories = implode(",", $expensesCategories);
    $inCategory = 'in:'. $categories;

    $methods = implode(",", $paymentMethods);
    $inMethod = 'in:'. $methods;


    $this->validator->validate($formData, [
      'expense_amount' => ['required', 'numeric'],
      'expense_date' => ['required', 'dateFormat:Y-m-d'],
      'payment_method' => ['required', $inMethod],
      'expense_category' => ['required', $inCategory],
      'expense_comment' => ['lengthMax:100']

    ]);
  }
  public function validateIncome(array $formData, array $incomesCategories)
  {
    $categories = implode(",", $incomesCategories);
    $inCategory = 'in:'. $categories;
    
    $this->validator->validate($formData, [
      'income_amount' => ['required', 'numeric'],
      'income_date' => ['required', 'dateFormat:Y-m-d'],
      'income_category' => ['required', $inCategory ],
      'income_comment' => ['lengthMax:100']

    ]);
  }

  public function validateIncomeCategory(array $formData)
  {
    $this->validator->validate($formData, [
      'new_income_name' => ['required','length:2,50']
    ]);
  }

  public function validateExpenseCategory(array $formData)
  {
    $this->validator->validate($formData, [
      'new_expense_name' => ['required','length:2,50']
    ]);
  }

  public function validatePaymentMethod(array $formData)
  {
    $this->validator->validate($formData, [
      'new_payment_name' => ['required','length:2,50']
    ]);
  }
  
  public function validateEmail(array $formData)
  {
    $this->validator->validate($formData, [      
      'email' => ['required', 'email']      
    ]);
  }

  public function validateUsername(array $formData)
  {
    $this->validator->validate($formData, [      
      'username' => ['required', 'length:2,20', 'alfanum']      
    ]);
  }

  public function validatePassword(array $formData)
  {
    $this->validator->validate($formData, [      
      'password' => ['required'],
      'password2' => ['required', 'match:password']      
    ]);
  }


}
