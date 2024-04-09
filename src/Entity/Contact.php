<?php

namespace App\Entity;

use App\Core\Repository\EntityInterface;

class Contact implements EntityInterface {
  public ?int $id = null;
  public string $name = '';
  public string $phone = '';

  public function getId(): ?int {
    return $this->id;
  }

  public function setId(int $id): void {
    $this->id = $id;
  }

  public function getName(): string {
    return $this->name;
  }

  public function setName(string $name): void {
    $this->name = $name;
  }

  public function getPhone(): string {
    return $this->phone;
  }

  public function setPhone(string $phone): void {
    $this->phone = $phone;
  }

}