<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;
use App\Models\Invoice;
use App\Models\User;
use App\Models\SignUp;

class HomeController
{
  public function index(): View
  {
    return View::make("index", []);
  }
}
