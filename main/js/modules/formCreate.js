// Функция создания формы(поля для ввода числа) и div для истории чисел
function formCreate(history_num) {
  $("#main_div").empty(); // очищаем main_div
  let form = `
            <h3>Введите ваше число, которое загадали:</h3>
            <form action="" method="post">
                      <div class="form-group">
                     <label for="nput_number" style="color: grey;">Двухзначное число </label>
                     <input type="text" class="form-control" id="InputNumber1" placeholder="00" name="input_number" >
                      </div>
                    <div id="history"><p>История ваших чисел: </p><span id="span_history">${history_num}</span></div>
                      <button type="submit" class="btn btn-primary">Отправить</button>
            </form>`;
  $("#main_div").append(form);

};

//required pattern="[0-9]{2}"