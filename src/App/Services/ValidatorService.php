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

  public function validateExpense(array $formData)
  {
    $expensesCategories = [];


    $this->validator->validate($formData, [
      'expense_amount' => ['required', 'numeric'],
      'expense_date' => ['required', 'dateFormat:Y-m-d'],
      'payment_method' => ['required', 'in:Karta płatnicza,Gotówka'],
      'expense_category' => ['required', 'in:Jedzenie,Paliwo'],
      'expense_comment' => ['lengthMax:100']

    ]);
  }
  public function validateIncome(array $formData)
  {

    $this->validator->validate($formData, [
      'income_amount' => ['required', 'numeric'],
      'income_date' => ['required', 'dateFormat:Y-m-d'],
      'income_category' => ['required', 'in:Wynagrodzenie,Odsetki bankowe'],
      'income_comment' => ['lengthMax:100']

    ]);
  }
  /*public function validateBalanceDates(array $formData) 
  {
    $endDate = $formData['custom_date_end'];

    $this->validator->validate($formData,[
      'custom_date_start' => ['dateMax', 'dateRange:$endDate'],
      'custom_date_end' => []
    ]);
  }*/
}
