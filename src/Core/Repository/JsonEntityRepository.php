<?php

namespace App\Core\Repository;

class JsonEntityRepository implements EntityRepositoryInterface {

  public function __construct(
    protected readonly string $jsonPath,
    protected readonly string $entityClass
  ) {
  }

  public function getFullPath(): string {
    return ROOT_APP . $this->jsonPath;
  }

  public function findById(int $id): ?EntityInterface {
    $data = $this->findAll();
    foreach ($data as $entity) {
      if ($id === $entity->getId()) {
        return $entity;
      }
    }

    return null;
  }

  public function save(EntityInterface $entity): void {
    $data = $this->findAll();
    $fp   = fopen($this->getFullPath(), "w");

    if (flock($fp, LOCK_EX)) {
      if (null === $entity->getId()) {
        $newId = count($data) > 0 ? $data[count($data) - 1]->getId() + 1 : 1;
        $entity->setId($newId);
        $data[] = $entity;
      } else {
        foreach ($data as $index => $dataEntity) {
          if ($dataEntity->getId() === $entity->getId()) {
            $data[$index] = $entity;
          }
        }
      }

      fwrite($fp, json_encode($data));
      flock($fp, LOCK_UN);
    } else {
      throw new \RuntimeException('Write locked');
    }

    fclose($fp);
  }

  public function findAll(): array {
    $rawJson = file_get_contents($this->getFullPath());
    $data    = json_decode($rawJson, true);

    $result = [];
    foreach ($data as $row) {
      $model = new $this->entityClass;
      foreach ($row as $key => $value) {
        if (property_exists($model, $key)) {
          $model->{$key} = $value;
        }
      }
      $result[] = $model;
    }

    return $result;
  }

  public function deleteById(int $id): void {
    $data = $this->findAll();
    $fp   = fopen($this->getFullPath(), "w");
    if (flock($fp, LOCK_EX)) {
      foreach ($data as $index => $entity) {
        if ($id === $entity->getId()) {
          unset($data[$index]);
          fwrite($fp, json_encode($data));
          break;
        }
      }

      flock($fp, LOCK_UN);
    }

    fclose($fp);
  }
}