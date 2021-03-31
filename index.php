<?php
// Импорт класса Person для создание персонажей
include 'person.php';
?>

<?php
// СТАРТ СЕССИИ И ГЕНЕРАЦИЯ ПЕРСОНАЖЕЙ

session_start ();
ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting (E_ALL);

if (!isset($_SESSION['Bender'])) {
    $_SESSION["Bender"] = new Person();
}
if (!isset($_SESSION['Lila'])) {
    $_SESSION['Lila'] = new Person();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Игра - "Загадай число!"</title>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>	
<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
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
            location.reload()
           
        }
        
    }


}
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
        <h3>Привет!</h3> 
        <p class="welcome_text"> Нас зовут Лила и Бендер. </p>
        <p class="welcome_text"> Мы соревнуемся в угадывании чисел.</p> 
        <p class="welcome_text"> Пожалуйста, загадай двухзначное число </p>
        <p class="welcome_text"> и нажми кнопку! </p>
    <button onclick="main()" type="submit" class="btn btn-primary">Я загадал!</button>
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
