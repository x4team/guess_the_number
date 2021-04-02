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
        // Запрещаем повторную отправку данных в ВСЕХ форм при обновлении страницы
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
<body>

<!-- ГЛАВНАЯ ФУНКЦИЯ -->
<script>
const main = () => {
    // Очищаем диалоговую область main_div
    const mainDiv = document.getElementById("main_div");
    mainDiv.textContent = '';
    
    // Угадываем персонажами числа (Вызываем метод получения числа)
    <?php $_SESSION['Lila']->guessMethod(); ?>
    <?php $_SESSION['Bender']->guessMethod(); ?>

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

    // Функци я создания параграфа
    let paragraphCreate = (text) => {
        var para = document.createElement("P");   
        para.innerText = text;
        para.className = "answer";   
        document.getElementById("main_div").appendChild(para);  
    }

    // ВЫВОДИМ ЗНАЧЕНИЯ И КНОПКИ
    let lilaAnswer = paragraphCreate(`Лила: <?php echo $_SESSION["Lila"]->num; ?> `);
    let benderAnswer = paragraphCreate(`Бендер: <?php echo $_SESSION["Bender"]->num; ?> `);

    let buttonLila = buttonCreate("Лила");
    let buttonNobody = buttonCreate("Никто");
    let buttonBender = buttonCreate("Бендер");

    // Обновление счетчика
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

<!-- ФУНКЦИЯ СОЗДАНИЯ ФОРМЫ -->
<script src="js/modules/formCreate.js">
</script>

<div class="container ">
    <div class="lila">
    <div >
        <div >
          <a href="#"><i class="fa fa-flag-o orange"></i></a>
          <h2 id="lila_count"><?php echo $_SESSION['Lila']->counter; ?></h2>
        </div>
      </div>
        <img src="img/lilla.png">
    </div>
    <div id="main_div">
    <!-- Проверка на существование игры и стартовая генерация основного блока main_div -->
    <script>
    let startGame = (numbers) => { 
      let welcome = `
      <h3>Привет!</h3> 
        <p class="welcome_text"> Нас зовут Лила и Бендер. </p>
        <p class="welcome_text"> Мы соревнуемся в угадывании чисел.</p> 
        <p class="welcome_text"> Пожалуйста, загадай двухзначное число </p>
        <p class="welcome_text"> и нажми кнопку! </p>
        <button onclick="formCreate('${numbers}')" type="submit" class="btn btn-primary">Я загадал!</button>
      `;
      $("#main_div").append(welcome);
    };
    let continueGame = (numbers) => {
        
      let game = `
        <h3>Продолжаем играть!</h3> 
        <p class="welcome_text"> Загадай двухзначное число </p>
        <p class="welcome_text"> и нажми кнопку! </p>
        <button onclick="formCreate('${numbers}')" type="submit" class="btn btn-primary">Я загадал!</button>
      `;
        $("#main_div").append(game);
    };
    </script>
    <?php
        $numbers = implode(",", $_SESSION["User"]->numbers);
        // Проверям есть ли в массиве первый элемент, если да - то продолжаем игру
        if ($_SESSION["User"]->isUserSend) {
            var_dump($_SESSION["User"]->isUserSend);
            echo "<script>main()</script>";
        } else if ($_SESSION["User"]->numbers && !$_SESSION["User"]->isUserSend) {        
            echo "<script>continueGame(\"{$numbers}\");</script>";
        }
        else {
            echo "<script>startGame(\"{$numbers}\")</script>";
        }
    ?>
    </div>
    <div class="bender">
        <div>
            <div>
                 <a href="#"><i class="fa fa-flag-o blue"></i></a>
                <h2 id="bender_count"><?php echo $_SESSION['Bender']->counter; ?></h2>
            </div>
        </div>
        <img src="img/bender.png">
    </div>
</div>

</body>
</html>


