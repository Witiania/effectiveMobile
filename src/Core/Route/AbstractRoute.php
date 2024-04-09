<?php

namespace App\Core\Route;

abstract class AbstractRoute {
  protected Router $router;

  public function __construct(Router $router) {
    $this->router = $router;
  }

  abstract public function load();
}