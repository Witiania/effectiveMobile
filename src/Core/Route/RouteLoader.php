<?php

namespace App\Core\Route;

class RouteLoader {
  /** @var AbstractRoute[] */
  protected array $routes = [];
  protected Router $router;

  public function __construct(Router $router, array $routes) {
    $this->router = $router;

    foreach ($routes as $route) {
      $this->routes[] = new $route($router);
    }
  }

  public function load(): void {
    foreach ($this->routes as $route) {
      $route->load();
    }
  }
}