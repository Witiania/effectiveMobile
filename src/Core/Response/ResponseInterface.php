<?php

namespace App\Core\Response;

interface ResponseInterface {
  public function getBody(): string;

  public function getStatus(): int;

  public function getContentType(): string;
}