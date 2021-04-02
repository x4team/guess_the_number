<?php
if (!isset($_SESSION['Bender'])) {
    $_SESSION["Bender"] = new Person();
}
if (!isset($_SESSION['Lila'])) {
    $_SESSION['Lila'] = new Person();
}

if (!isset($_SESSION['User'])) {
    $_SESSION['User'] = new User();
}
?>