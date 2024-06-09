<?php

declare(strict_types=1);

namespace App;


class Config
{
  protected array $config = [];

  public function __construct(array $env)
  {
    $this->config =  [
      "db" => [
        "driver" => $env["DB_DRIVER"],
        "host" => $env["DB_HOST"],
        "port" => $env["DB_PORT"],
        "database" => $env["DB_NAME"],
        "user" => $env["DB_USER"],
        "password" => $env["DB_PASS"],
      ]
    ];
  }

  public function get(string $key): mixed
  {
    return $this->config[$key] ?? null;
  }
}
