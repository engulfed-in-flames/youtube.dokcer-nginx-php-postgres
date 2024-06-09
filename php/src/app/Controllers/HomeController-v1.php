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
    $email = "alton@john.com";
    $name = "Alton John";
    $amount = 100.00;

    $userModel = new User();
    $invoiceModel = new Invoice();

    $invoiceId = (new SignUp($userModel, $invoiceModel))->register(
      [
        "email" => $email,
        "name" => $name,
      ],
      [
        "amount" => $amount,
      ]
    );

    return View::make("index", [
      "invoice" => $invoiceModel->find($invoiceId),
    ]);
  }
}
