<?php

namespace App\Core\Repository;

interface EntityRepositoryInterface {
  public function findById(int $id): ?EntityInterface;

  /**
   * @return EntityInterface[]
   */
  public function findAll(): array;

  public function save(EntityInterface $entity): void;

  public function deleteById(int $id): void;
}