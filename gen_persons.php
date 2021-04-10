<?php
// Импортируем хранилище и стартуем сессию
include 'Storage.php';
$storage = new Storage();

// Создаем персонажей и пользователя
$storage->setStorageId('Lila', new Person());
$storage->setStorageId('Bender', new Person());
$storage->setStorageId('User', new User());
