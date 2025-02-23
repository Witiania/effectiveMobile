<?php

namespace App\Core\Repository;

interface EntityInterface {
  public function getId(): ?int;

  public function setId(int $id): void;
}