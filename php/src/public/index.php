<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Container;
use App\Router;
use App\Config;
use App\App;
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

if (session_status() !== PHP_SESSION_ACTIVE) session_start();

define("STORAGE_PATH", __DIR__ . "/../storage");
define("VIEW_PATH", __DIR__ . "/../views");

$container = new Container();
$router = new Router($container);

$router
  ->get("/", [HomeController::class, "index"])
  ->get("/invoices", [InvoiceController::class, "index"])
  ->get("/invoices/create", [InvoiceController::class, "create"])
  ->post("/invoices/create", [InvoiceController::class, "store"]);

(new App(
  $router,
  [
    "uri" => $_SERVER["REQUEST_URI"],
    "method" => $_SERVER["REQUEST_METHOD"],
  ],
  new Config($_ENV)
))->run();
