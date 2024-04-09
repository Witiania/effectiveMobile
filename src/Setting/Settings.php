<?php

namespace App\Setting;

use App\Setting\Router\ContactRouter;

class Settings {
  public array $routes = [
    ContactRouter::class
  ];
}