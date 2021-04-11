<?php
// Активация ошибок на странице
include 'debug.php';

// Импорт класса Person и User для создание персонажей и пользователя
include 'Person.php';
include 'User.php';

// Активация хранилища (СТАРТ СЕССИИ $storage) и генерации персонажей и пользователя
include 'gen_persons.php';

// Импорт POST для формы
include 'POST.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Игра - "Загадай число!"</title>
    <script src="https://kit.fontawesome.com/35234960be.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<script>
    // Запрещаем повторную отправку данных в форму при обновлении страницы
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<body>
    <!-- Скрипт с функцией СОЗДАНИЯ ФОРМЫ-->
    <script src="js/modules/formCreate.js"></script>

    <div class="container ">
        <!-- ИЗОБРАЖЕНИЕ ЛИЛЫ И ЕЕ ДАННЫЕ -->
        <div class="lila">
            <div>
                <div>
                    <a href="#"><i class="fa fa-flag-o orange"></i></a>
                    <h2 id="lila_count"><?php echo $storage->getStorageId('Lila')->guess_rating; ?></h2>
                </div>
            </div>
            <img id="person" src="img/lilla.png">
            <div id="history_lila">
                <p>История угадываний: </p><span id="span_history"><?php echo implode(",", $storage->getStorageId('Lila')->numbers_history); ?></span>
            </div>
        </div>

        <div id="main_div">
            <!-- Скрипт с функцией СТАРТА игры-->
            <script src="js/modules/startGame.js"></script>
            <!-- Скрипт с функцией ПРОДОЛЖЕНИЯ игры-->
            <script src="js/modules/continueGame.js"> </script>

            <!-- СТАРТ Диалогового окна в зависимости от сессии (Старт, Продолжение игры, Выбор победителя) -->
            <?php
            $numbers = implode(",", $storage->getStorageId('User')->numbers);
            $num_bender = $storage->getStorageId('Bender')->num;
            $num_lila = $storage->getStorageId('Lila')->num;
            $num_user = $storage->getStorageId('User')->number;
            // Проверям есть ли в массиве первый элемент, если да - то продолжаем игру
            if ($storage->getStorageId('User')->numbers) {
                echo "<script>continueGame(\"{$numbers}\", \"{$num_bender}\", \"{$num_lila}\", \"{$num_user}\");</script>";
            } else {
                echo "<script>startGame(\"{$numbers}\")</script>";
            }
            ?>
        </div>

        <!-- ИЗОБРАЖЕНИЕ БЕНДЕРА И ЕГО ДАННЫЕ -->
        <div class="bender">
            <div>
                <div>
                    <a href="#"><i class="fa fa-flag-o blue"></i></a>
                    <h2 id="bender_count"><?php echo $storage->getStorageId('Bender')->guess_rating; ?></h2>
                </div>
            </div>
            <img id="person" src="img/bender.png">
            <div id="history_bender">
                <p>История угадываний: </p><span id="span_history"><?php echo implode(",", $storage->getStorageId('Bender')->numbers_history); ?></span>
            </div>
        </div>
    </div>

</body>

</html>