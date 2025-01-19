<?php

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class DateRangeMaxRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {   
    $startDate = $data[$field];
    return $startDate <= date("Y-m-d");
  }

  public function getMessage(array $data, string $field, array $params): string
  {
    return "Data początkowa nie może być późniejsza niż bieżąca";
  }
}

        