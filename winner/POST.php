<?php
if (!empty($_POST['input_number'])) {
    $input_number = $_POST['input_number'];
    if (is_numeric($input_number) && $input_number > 9 && $input_number < 100) {
        $storage->getStorageId('User')->sendNumber($input_number);
        $storage->getStorageId('User')->number = $input_number;
        $storage->getStorageId('User')->isUserSend = true;
        include 'guess_method.php';
    } else {
        $nameErr = '<div id="form_validator">Поле ввода принимает только двухзначные числа!</div> ';
        echo $nameErr;
    }
} elseif (empty($_POST["input_number"]) && isset($_POST["input_number"])) {
    $nameErr = '<div id="form_validator">Поле ввода не должно быть пустым!</div> ';
    echo $nameErr;
}
