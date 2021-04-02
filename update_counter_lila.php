<?php 
include 'user.php';
include 'person.php';
session_start();
	$_SESSION['Lila']->counterMethod();
	$_SESSION['User']->isUserSend = false;
?>
