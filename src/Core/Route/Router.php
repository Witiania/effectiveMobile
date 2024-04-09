<?php

namespace App\Core\Route;

use App\Core\Request\Request;
use App\Core\Response\RedirectResponse;
use App\Core\Response\ResponseInterface;

class Router {
  private array $routes = [];

  public function __construct(protected readonly Request $request) {
  }

  public function get(string $url, callable $handler): void {
    $this->addRoute($url, Request::METHOD_GET, $handler);
  }

  public function post(string $url, callable $handler): void {
    $this->addRoute($url, Request::METHOD_POST, $handler);
  }

  public function any(string $url, callable $handler): void {
    $this->get($url, $handler);
    $this->post($url, $handler);
  }

  public function handle(): void {
    $method = $this->request->getMethod();
    $url    = $this->request->getUrlPath();

    if (array_key_exists($method, $this->routes)) {
      foreach ($this->routes[$method] as $routeUrl => $routeData) {
        $routeSegments = $routeData['segments'];

        if (count($routeSegments) === count(explode('/', $url))) {
          $urlSegments = explode('/', $url);
          $params      = [];

          $match = true;
          foreach ($routeSegments as $key => $segment) {
            if ($segment !== $urlSegments[$key] && !empty($segment) && $segment[0] !== '{' && $segment[strlen($segment) - 1] !== '}') {
              $match = false;
              break;
            }

            if (isset($segment[0]) && $segment[0] === '{' && $segment[strlen($segment) - 1] === '}') {
              $paramName          = substr($segment, 1, strlen($segment) - 2);
              $params[$paramName] = $urlSegments[$key];
            }
          }

          if ($match) {
            $handler  = $routeData['handler'];
            $response = $handler($this->request, ...$params);
            if ($response instanceof ResponseInterface) {
              $this->sendResponse($response);
            }
            return;
          }
        }
      }
    }

    echo "Error 404: Page not found";
  }

  protected function addRoute(string $url, string $method, callable $handler): void {
    $this->routes[$method][$url] = [
      'handler'  => $handler,
      'segments' => explode('/', $url),
    ];
  }

  protected function sendResponse(ResponseInterface $response): void {
    if ($response instanceof RedirectResponse) {
      header('Location: ' . $response->getUrl());
      exit;
    }

    http_response_code($response->getStatus());
    header("Content-Type: {$response->getContentType()}");
    echo $response->getBody();
    exit();
  }
}