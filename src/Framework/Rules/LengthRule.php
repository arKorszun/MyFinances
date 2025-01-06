<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;
use InvalidArgumentException;

class LengthRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    if(empty($params[0]) || empty($params[1])){
      throw new InvalidArgumentException("Minimum or Maximum length not specified");
    }

    $minLength = (int) $params[0];
    $maxLength = (int) $params[1];
    $length = strlen($data[$field]);

    if(($length < $minLength) || ($length > $maxLength)) return false;
    else return true;
  
  }
  public function getMessage(array $data, string $field, array $params): string
  {
    return "Długość musi się mieścić w zakresie od {$params[0]} do {$params[1]} znaków";
  }
}