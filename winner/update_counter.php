<?php
// Импорт класса Person и User
include 'Person.php';
include 'User.php';

// Импортируем хранилище и стартуем сессию
include 'Storage.php';
$storage = new Storage();
$storage->getStorageId($_POST["data"])->counterMethod();
$storage->getStorageId('User')->isUserSend = false;
