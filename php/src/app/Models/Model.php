<?php

declare(strict_types=1);

namespace App\Models;

use App\App;
use App\Database;

abstract class Model
{

  protected Database $db;

  public function __construct()
  {
    $this->db = App::db();
  }

  // Do NOT use in production
  public function fetchLazy(\PDOStatement $stmt)
  {
    foreach ($stmt as $record) {
      yield $record;
    }
  }
}
