<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class AlfanumericRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    return ctype_alnum($data[$field]);  
  }
  public function getMessage(array $data, string $field, array $params): string
  {
    return "Pole może zawierać tylko cyfry i litery (bez polskich znaków)";
  }
}