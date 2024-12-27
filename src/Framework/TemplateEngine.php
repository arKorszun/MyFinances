<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
  public function __construct(private string $basePath) {}

  public function render(string $template, array $data = [])
  {
    extract($data, EXTR_SKIP); //ekstrahuje tablice z danymi do pojedynczych zmiennych o nazwach kluczy z tablicy asocjacyjnej

    ob_start(); //otwiera bufor ładowanej strony

    include "{$this->basePath}/{$template}";

    $output = ob_get_contents();

    ob_end_clean();

    return $output;
  }
}
