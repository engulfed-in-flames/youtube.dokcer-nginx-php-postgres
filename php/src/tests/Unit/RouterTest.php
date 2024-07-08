<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Exceptions\RouteNotFoundException;
use App\Router;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
  private Router $router;

  protected function setUp(): void
  {
    parent::setUp();
    $this->router = new Router();
  }

  public function test_that_it_registers_a_get_route(): void
  {
    // Pattern 1: Given - When - Then
    // Pattern 2: Arrange - Act - Assert

    // When we call a register method
    $this->router->register("/users", ["Users", "index"], "get");

    $expected = [
      "get" => [
        "/users" => ["Users", "index"],
      ]
    ];

    // Then we assert route was registered
    $this->assertEquals($expected, $this->router->routes());
  }

  public function test_that_it_registers_a_post_route(): void
  {
    // Pattern 1: Given - When - Then
    // Pattern 2: Arrange - Act - Assert

    // When we call a register method
    $this->router->register("/users", ["Users", "index"], "post");

    $expected = [
      "post" => [
        "/users" => ["Users", "index"],
      ]
    ];

    // Then we assert route was registered
    $this->assertEquals($expected, $this->router->routes());
  }

  public function test_that_there_are_no_routes_when_router_is_created(): void
  {
    $this->assertEmpty((new Router())->routes());
  }

  #[DataProvider("route_not_found_cases")]
  public function test_that_it_throws_route_not_found_exception(
    string $request_uri,
    string $request_method
  ): void {
    $users = new class()
    {
      public function delete(): bool
      {
        return true;
      }
    };

    $this->router->post("/users", [$users::class, "store"]);
    $this->router->get("/users", ["Users", "index"]);

    $this->expectException(RouteNotFoundException::class);
    $this->router->resolve($request_uri, $request_method);
  }

  public static function route_not_found_cases(): array
  {
    return [
      ["/users", "put"],
      ["/invoices", "post"],
      ["/users", "get"],
      ["/users", "post"]
    ];
  }
}
