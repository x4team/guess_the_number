<?php 
include 'user.php';
include 'person.php';
session_start();
	$_SESSION['Bender']->counterMethod();
	$_SESSION['User']->isUserSend = false;
?>
