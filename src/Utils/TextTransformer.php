<?php
namespace App\Utils;

class TextTransformer
{
  /**
   * Transforms an input to uppercase
   *
   * @param string $input
   * @return string
   */
  public function toUppercase(string $input): string
  {
    return strtoupper($input);
  }
}
