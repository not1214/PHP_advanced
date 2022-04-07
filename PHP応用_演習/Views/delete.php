<?php
require_once('../Controllers/ContactController.php');

$contact = new ContactController;
$contact->destroy($_GET['id']);

?>
