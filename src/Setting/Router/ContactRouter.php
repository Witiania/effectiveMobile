<?php
namespace App\Setting\Router;

use App\Controller\ContactController;
use App\Core\Request\Request;
use App\Core\Response\ResponseInterface;
use App\Core\Route\AbstractRoute;

class ContactRouter extends AbstractRoute {
  public function load(): void
  {
    $this->router->get('/contact/{id}/delete', function(Request $request, $id): ResponseInterface {
      $controller = new ContactController();
      return $controller->delete($request, (int)$id);
    });

    $this->router->any('/contact/{id}', function(Request $request, $id): ResponseInterface {
      $controller = new ContactController();
      return $controller->addOrEdit($request, (int)$id);
    });

    $this->router->any('/contact', function(Request $request): ResponseInterface {
      $controller = new ContactController();
      return $controller->addOrEdit($request);
    });

    $this->router->get('/', function(Request $request): ResponseInterface {
      $controller = new ContactController();
      return $controller->index($request);
    });
  }
}