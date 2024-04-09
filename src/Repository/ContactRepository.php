<?php

namespace App\Repository;

use App\Core\Repository\JsonEntityRepository;
use App\Entity\Contact;

class ContactRepository extends JsonEntityRepository {
  public function __construct() {
    return parent::__construct('/../contact.json', Contact::class);
  }
}