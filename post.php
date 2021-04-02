<?php
if(!empty($_POST['input_number'])){
    $input_number = $_POST['input_number'];
    $_SESSION['User']->sendNumber($input_number);
    $_SESSION['User']->number = $input_number;
    $_SESSION['User']->isUserSend = true;

    include 'guess_method.php';
}
?>