<?php

$storage->getStorageId('Bender')->guessMethod();
$storage->getStorageId('Lila')->guessMethod();

// Берем загаданное число пользователя
$userNumber = $storage->getStorageId('User')->number;

// Определяем находится ли число в заданном интервале
function beSide($num, $min, $max)
{
    if ($num >= $min and $num <= $max) {
        return true;
    }
    return false;
}


// Обновляем рейтинг персонажей
function ratingDetermination($person, $number, $storage)
{

    // Определяем интервал угадывания (+-5 едениц)
    $min_int = $number - 5;
    $max_int = $number + 5;

    if (beSide($storage->getStorageId($person)->num, $min_int, $max_int)) {
        $storage->getStorageId($person)->guess_rating += 1;
    } else {
        $storage->getStorageId($person)->guess_rating -= 1;
    }
};

ratingDetermination('Bender', $userNumber, $storage);
ratingDetermination('Lila', $userNumber, $storage);
