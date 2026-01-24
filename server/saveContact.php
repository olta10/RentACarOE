<?php
require_once 'classes/Contact.php';
require_once 'classes/Validator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = Validator::clean($_POST['name'] ?? '');
    $email = Validator::clean($_POST['email'] ?? '');
    $message = Validator::clean($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        header("Location: ../public/contact.php?error=1");
        exit;
    }

    if (!Validator::email($email)) {
        header("Location: ../public/contact.php?error=email");
        exit;
    }

    $contact = new Contact();
    $contact->save($name, $email, $message);

    header("Location: ../public/contact.php?success=1");
}
