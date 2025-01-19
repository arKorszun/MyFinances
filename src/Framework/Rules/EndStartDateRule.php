<?php

declare(strict_types=1);

namespace Framework\Rules;

use Framework\Contracts\RuleInterface;

class EndStartDateRule implements RuleInterface
{
  public function validate(array $data, string $field, array $params): bool
  {
    $startDate = $data[$field];
    $endDate = $data[$params[0]];

    return $startDate > $endDate;
  }
  public function getMessage(array $data, string $field, array $params): string
  {
    return "Data początkowa nie może być późniejsza niż końcowa";
  }
}