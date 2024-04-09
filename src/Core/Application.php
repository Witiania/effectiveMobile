<?php

namespace App\Core;

use App\Core\Request\Request;
use App\Core\Route\RouteLoader;
use App\Core\Route\Router;
use App\Setting\Settings;

class Application {
  protected Request $request;
  protected Router $router;
  protected Settings $settings;

  public function __construct() {
    $this->request = new Request();
    $this->router = new Router($this->request);
    $this->settings = new Settings();
  }

  public function getRequest(): Request {
    return $this->request;
  }

  public function getRouter(): Router {
    return $this->router;
  }

  public function run(): void {

    $routeLoader = new RouteLoader($this->getRouter(), $this->settings->routes);
    $routeLoader->load();

    $this->getRouter()->handle();
  }
}
