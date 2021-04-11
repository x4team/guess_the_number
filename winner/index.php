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
    <!--Функция обновление счетчика угадываний и состояние(флага) отправки updateCounter-->
    <script src="js/modules/updateCounter.js"></script>

    <!--Функция создания кнопок для выбора победителя buttonCreate-->
    <script src="js/modules/buttonCreate.js"></script>

    <!--Функция создания параграфа paragraphCreate -->
    <script src="js/modules/paragraphCreate.js"></script>

    <!-- Функция выбора победителя -->
    <script>
        const chooseWinner = () => {
            // Очищаем диалоговую область main_div
            const mainDiv = document.getElementById("main_div");
            mainDiv.textContent = '';

            // Создаем заголовок h3 с призывом выбрать победителя
            let node = document.createElement("h3");
            let textnode = document.createTextNode("Выбери того, кто угадал твое число");
            node.appendChild(textnode);
            document.getElementById("main_div").appendChild(node);

            // ВЫВОДИМ ЗНАЧЕНИЯ И КНОПКИ
            paragraphCreate(`<?php echo $storage->getStorageId('Lila')->name; ?>: <?php echo $storage->getStorageId('Lila')->num; ?> `);
            paragraphCreate(`<?php echo $storage->getStorageId('Bender')->name; ?>: <?php echo $storage->getStorageId('Bender')->num; ?> `);

            buttonCreate(`<?php echo $storage->getStorageId('Lila')->name; ?>`, `<?php echo $storage->getStorageId('Lila')->id; ?>`);
            buttonCreate(`Никто`);
            buttonCreate(`<?php echo $storage->getStorageId('Bender')->name; ?>`, `<?php echo $storage->getStorageId('Bender')->id; ?>`);

        }
    </script>

    <!-- Скрипт с функцией СОЗДАНИЯ ФОРМЫ-->
    <script src="js/modules/formCreate.js"></script>

    <div class="container ">
        <!-- ИЗОБРАЖЕНИЕ ЛИЛЫ И ЕЕ ДАННЫЕ -->
        <div class="lila">
            <div>
                <div>
                    <a href="#"><i class="fa fa-flag-o orange"></i></a>
                    <h2 id="lila_count"><?php echo $storage->getStorageId('Lila')->counter; ?></h2>
                </div>
            </div>
            <img id="person" src="img/lilla.png">
            <div id="rating">
                <p>Рейтинг: </p><span id="span_history"><?php echo $storage->getStorageId('Lila')->guess_rating; ?></span>
            </div>
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
            // Проверям есть ли в массиве первый элемент, если да - то продолжаем игру
            if ($storage->getStorageId('User')->isUserSend) {
                echo "<script>chooseWinner()</script>";
            } else if ($storage->getStorageId('User')->numbers && !$storage->getStorageId('User')->isUserSend) {
                echo "<script>continueGame(\"{$numbers}\");</script>";
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
                    <h2 id="bender_count"><?php echo $storage->getStorageId('Bender')->counter; ?></h2>
                </div>
            </div>
            <img id="person" src="img/bender.png">
            <div id="rating">
                <p>Рейтинг: </p><span id="span_history"><?php echo $storage->getStorageId('Bender')->guess_rating; ?></span>
            </div>
            <div id="history_bender">
                <p>История угадываний: </p><span id="span_history"><?php echo implode(",", $storage->getStorageId('Bender')->numbers_history); ?></span>
            </div>
        </div>
    </div>

</body>

</html>