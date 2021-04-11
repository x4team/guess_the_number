<?php
if (!empty($_POST['input_number'])) {
    $input_number = $_POST['input_number'];
    $storage->getStorageId('User')->sendNumber($input_number);
    $storage->getStorageId('User')->number = $input_number;
    $storage->getStorageId('User')->isUserSend = true;

    include 'guess_method.php';
}
