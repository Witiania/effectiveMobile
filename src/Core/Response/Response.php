<?php

namespace App\Core\Response;

class Response implements ResponseInterface {
  public function __construct(
    protected string $body = '',
    protected int $status = 200,
    protected string $contentType = 'text/html'
  ) {
  }

  public function getBody(): string {
    return $this->body;
  }

  public function getStatus(): int {
    return $this->status;
  }

  public function getContentType(): string {
    return $this->contentType;
  }

  public function setBody(string $body): void {
    $this->body = $body;
  }

  public function setStatus(int $status): void {
    $this->status = $status;
  }

  public function setContentType(string $contentType): void {
    $this->contentType = $contentType;
  }
}