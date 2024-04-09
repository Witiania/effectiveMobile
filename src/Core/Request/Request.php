<?php

namespace App\Core\Request;

class Request {
  public const METHOD_GET  = 'GET';
  public const METHOD_POST = 'POST';

  public function get(string $key, $default = null): mixed {
    return $_GET[$key] ?? $default;
  }

  public function post(string $key, $default = null) {
    return $_POST[$key] ?? $default;
  }

  public function getAll(): array {
    return $_REQUEST;
  }

  public function getMethod(): string {
    return (string)$_SERVER['REQUEST_METHOD'];
  }

  public function getUrlPath(): string {
    return (string)parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  }
}