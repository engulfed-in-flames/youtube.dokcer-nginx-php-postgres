<?php

declare(strict_types=1);

namespace App\Controllers;

use Generator;

class GeneratorExampleController
{
  public function __construct()
  {
  }

  public function index()
  {
    // This array is built in memory once the range function is called
    // The larger number you pass, The more it would be memory intensive operation
    // $numbers = range(1, 10);

    // echo "<pre>";
    // print_r($numbers);
    // echo "</pre>";

    $numbers = $this->lazyRange(1, 1_000_000);

    foreach ($numbers as $key => $number) {
      echo $key .  " : " . (string) $number . "<br/>";
    }
  }

  // Should be implemented as a helper function in somewhere else.
  private function lazyRange(int $start, int $end): Generator
  {
    // Execute the code after the first yield statement is called.
    echo "Hello Generator!<br/>";

    for ($i = $start; $i <= $end; $i++) {
      // `yield` pauses generator function whereas `return` stop function execution
      // yield $i;
      yield $i * 5 => $i;
    }
  }
}
