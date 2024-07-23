<?php


declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;
use App\Services\PaymentGatewayService;
use App\Services\PaymentGatewayInterface;

class App
{
  private static Database $db;

  public function __construct(
    protected Container $container,
    protected Router $router,
    protected array $request,
    protected Config $config,
  ) {
    static::$db = new Database($config->get("db") ?? []);

    $this->container->set(
      // What is the benefit of injecting interface? Loose coupling, easy to swap
      PaymentGatewayInterface::class,
      PaymentGatewayService::class
    );
  }

  public static function db(): Database
  {
    return static::$db;
  }

  public function run()
  {

    try {
      echo $this->router->resolve(
        $this->request['uri'],
        $this->request['method']
      );
    } catch (RouteNotFoundException) {
      http_response_code(404);

      echo View::make("error/404");
    }
  }
}
