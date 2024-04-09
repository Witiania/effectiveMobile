<?php

namespace App\Controller;

use App\Core\Request\Request;
use App\Core\Response\RedirectResponse;
use App\Core\Response\RenderResponse;
use App\Core\Response\Response;
use App\Core\Response\ResponseInterface;
use App\Entity\Contact;
use App\Repository\ContactRepository;

class ContactController {
  private ContactRepository $repository;

  public function __construct() {
    $this->repository = new ContactRepository();
  }

  public function index(Request $request): ResponseInterface {
    $contacts = $this->repository->findAll();

    return new RenderResponse('/Contact/index.php', [
      'contacts' => $contacts,
    ]);
  }

  public function addOrEdit(Request $request, $id = null): ResponseInterface {
    $model = new Contact();
    if (null !== $id) {
      $model = $this->repository->findById((int)$id);
      if (null === $model) {
        return new Response('Not found', 404);
      }
    }

    if (Request::METHOD_POST === $request->getMethod()) {
      $model->setName($request->post('name'));
      $model->setPhone($request->post('phone'));
      $this->repository->save($model);

      return new RedirectResponse('/');
    }

    return new RenderResponse('/Contact/form.php', [
      'contact' => $model,
    ]);
  }

  public function delete(Request $request, $id): ResponseInterface {
    $model = $this->repository->findById((int)$id);
    if (null === $model) {
      return new Response('Not found', 404);
    }

    $this->repository->deleteById($model->getId());

    return new RedirectResponse('/');
  }
}