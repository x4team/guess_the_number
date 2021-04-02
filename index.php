<?php
// Активация ошибок на странице
include 'debug.php';

// Импорт класса Person и User для создание персонажей и пользователя
include 'person.php';
include 'user.php';

// СТАРТ СЕССИИ
session_start ();

// ГЕНЕРАЦИЯ ПЕРСОНАЖЕЙ И ПОЛЬЗОВАТЕЛЯ
include 'gen_persons.php';

// Импорт POST для формы
include 'post.php';

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
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<body>

<!-- Функция выбора победителя -->
<script>
const chooseWinner = () => {
    // Очищаем диалоговую область main_div
    const mainDiv = document.getElementById("main_div");
    mainDiv.textContent = '';


    // Создаем заголовок h3 с призывом выбрать победителя
    var node = document.createElement("h3");                 
    var textnode = document.createTextNode("Выбери того, кто угадал твое число");       
    node.appendChild(textnode);                             
    document.getElementById("main_div").appendChild(node);    
    
    

    // Функция создания кнопок для выбора победителя
    let buttonCreate = (text) => {
        btn = document.createElement("BUTTON");
        btn.innerHTML = text; 
        btn.className = "btn btn-primary";
        document.getElementById("main_div").appendChild(btn); 
        if (text == "Никто") {
            btn.setAttribute("id","nobody")
            document.getElementById("nobody").onclick = function() { updateCounter("Nobody") };
        } else if (text == "Лила") {
            btn.setAttribute("id","lila")
            document.getElementById("lila").onclick = function() { updateCounter("Lila") };
        } else if (text == "Бендер") {
            btn.setAttribute("id","bender")
            document.getElementById("bender").onclick = function() { updateCounter("Bender") };
        }
         
    }

    // Функция создания параграфа
    let paragraphCreate = (text) => {
        var para = document.createElement("P");   
        para.innerText = text;
        para.className = "answer";   
        document.getElementById("main_div").appendChild(para);  
    }

    // ВЫВОДИМ ЗНАЧЕНИЯ И КНОПКИ
    paragraphCreate(`Лила: <?php echo $_SESSION["Lila"]->num; ?> `);
    paragraphCreate(`Бендер: <?php echo $_SESSION["Bender"]->num; ?> `);

    buttonCreate("Лила");
    buttonCreate("Никто");
    buttonCreate("Бендер");

    // Обновление счетчика угадываний и состояние(флага) отправки
    const updateCounter = (person) => {
        if (person == 'Lila') {
	        // Запрос на изменение данных в сессии через ajax	
	        $.ajax({
		        type: 'POST',
		        url: "update_counter_lila.php",
		        success: function(data){
      	        		document.getElementById("lila_count").innerHTML = <?php echo $_SESSION['Lila']->counter; ?>;
                   		location.reload();
		     }
   	     });
        }
        if (person == 'Bender') {
	        $.ajax({
                type: 'POST',
                url: "update_counter_bender.php",
                success: function(data){
                        document.getElementById("bender_count").innerHTML = <?php echo $_SESSION['Bender']->counter; ?>;
                        location.reload();
                }
            });
        }
        if (person == 'Nobody') {
            $.ajax({
                type: 'POST',
                url: "nobody_reload.php",
                success: function(data){
                        location.reload();
                }
            });
           
        } 
    }
}
</script>

<!-- Скрипт с функцией СОЗДАНИЯ ФОРМЫ-->
<script src="js/modules/formCreate.js"></script>

<div class="container ">
    <!-- ИЗОБРАЖЕНИЕ ЛИЛЫ И ЕЕ ДАННЫЕ -->
    <div class="lila">
    <div >
        <div >
          <a href="#"><i class="fa fa-flag-o orange"></i></a>
          <h2 id="lila_count"><?php echo $_SESSION['Lila']->counter; ?></h2>
        </div>
      </div>
        <img id="person" src="img/lilla.png">
        <div id="rating"><p>Рейтинг: </p><span id="span_history"><?php echo $_SESSION['Lila']->guess_rating; ?></span></div>
        <div id="history_lila"><p>История угадываний: </p><span id="span_history"><?php echo implode(",", $_SESSION['Lila']->numbers_history); ?></span></div>
    </div>

    <div id="main_div">
        <!-- Скрипт с функцией СТАРТА игры-->
        <script src="js/modules/startGame.js"></script>
        <!-- Скрипт с функцией ПРОДОЛЖЕНИЯ игры-->
        <script src="js/modules/continueGame.js"> </script>

        <!-- СТАРТ Диалогового окна в зависимости от сессии (Старт, Продолжение игры, Выбор победителя) -->
        <?php
             $numbers = implode(",", $_SESSION["User"]->numbers);
             // Проверям есть ли в массиве первый элемент, если да - то продолжаем игру
             if ($_SESSION["User"]->isUserSend) {
                    echo "<script>chooseWinner()</script>";
            } else if ($_SESSION["User"]->numbers && !$_SESSION["User"]->isUserSend) {        
                     echo "<script>continueGame(\"{$numbers}\");</script>";
            }
            else {
                echo "<script>startGame(\"{$numbers}\")</script>";
             }
        ?>
    </div>

    <!-- ИЗОБРАЖЕНИЕ БЕНДЕРА И ЕГО ДАННЫЕ -->
    <div class="bender">
        <div>
            <div>
                 <a href="#"><i class="fa fa-flag-o blue"></i></a>
                <h2 id="bender_count"><?php echo $_SESSION['Bender']->counter; ?></h2>
            </div>
        </div>
        <img id="person" src="img/bender.png">
        <div id="rating"><p>Рейтинг: </p><span id="span_history"><?php echo $_SESSION['Bender']->guess_rating; ?></span></div>
        <div id="history_bender"><p>История угадываний: </p><span id="span_history"><?php echo implode(",", $_SESSION['Bender']->numbers_history); ?></span></div>
    </div>
</div>

</body>
</html>


