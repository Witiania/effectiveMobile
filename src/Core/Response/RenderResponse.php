<?php

namespace App\Core\Response;

class RenderResponse extends Response {
  public function __construct(
    protected string $viewPath,
    protected array $viewData = [],
    int $status = 200,
    string $contentType = 'text/html'
  ) {
    return parent::__construct($this->render(), $status, $contentType);
  }

  protected function render(): string {
    extract( $this->viewData);
    ob_start();
    include ROOT_APP . '/View/' . $this->viewPath;
    return ob_get_clean();
  }
}