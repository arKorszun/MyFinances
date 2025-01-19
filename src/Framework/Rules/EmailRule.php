<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class EmailRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    $email = $data[$field];
    $email_safe = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($email_safe, FILTER_VALIDATE_EMAIL) == false) || ($email_safe != $email)) return false;
    else return true;
  }
  public function getMessage(array $data, string $field, array $params): string
  {
    return "Nieprawidłowy adres email";
  }
}
