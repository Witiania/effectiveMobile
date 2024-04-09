<?php
/**
 * @var Contact[] $contacts
 */

use App\Entity\Contact;

?>

<a href="/contact">Add</a><br><br>

<table>
  <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Phone</th>
      <th></th>
  </tr>
<?php foreach ($contacts as $contact): ?>
    <tr>
        <td><?=$contact->getId()?></td>
        <td><?=$contact->getName()?></td>
        <td><?=$contact->getPhone()?></td>
        <td>
            <a href="/contact/<?=$contact->getId()?>">Edit</a>
            <a href="/contact/<?=$contact->getId()?>/delete">Delete</a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
