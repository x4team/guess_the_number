<?php 
include 'user.php';
include 'person.php';
session_start();
$_SESSION['Lila']->guessMethod();
$_SESSION['Bender']->guessMethod(); 

// Берем загаданное число пользователя
$userNumber = $_SESSION['User']->number;

ratingDetermination('Bender', $userNumber);
ratingDetermination('Lila', $userNumber);

// Обновляем рейтинг персонажей
function ratingDetermination($person, $number) {
    // Определяем находится ли число в заданном интервале
    function beSide($num,$min,$max){
        if($num >= $min and $num <= $max){
           return true;
        }
        return false;
    }

    // Определяем интервал угадывания (+-5 едениц)
    $min_int = $number - 5;
    $max_int = $number + 5;

    if (beSide($_SESSION[$person]->num, $min_int, $max_int)) {
        $_SESSION[$person]->guess_rating += 1;
    } else {
        $_SESSION[$person]->guess_rating -= 1;
    }

};




?>