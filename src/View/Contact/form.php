<?php
/**
 * @var Contact $contact
 */

use App\Entity\Contact;

?>

<form method="post" action="/contact<?= null !== $contact->getId() ? '/' . $contact->getId() : '' ?>">
    <label>
        <input type="text" name="name" value="<?= $contact->getName() ?>" placeholder="Name">
    </label><br>
    <label>
        <input type="text" name="phone" value="<?= $contact->getPhone() ?>" placeholder="Phone">
    </label><br>
    <input type="submit">
</form>