<?php

namespace App\Core\Response;

class RedirectResponse extends Response {
  public function __construct(
    protected string $url = ''
  ) {
    parent::__construct('', 302);
  }

  public function getUrl(): string {
    return $this->url;
  }

  public function setUrl(string $url): void {
    $this->url = $url;
  }
}