let continueGame = (numbers_user, num_one, num_two, num_three) => {

  let game = `
      <h4>Бендер: ${num_one}</h4> 
      <h4>Лила: ${num_two}</h4>
      <h4>Вы: ${num_three}</h4>
      <h3>Продолжаем играть!</h3> 
      <p class="welcome_text"> Загадай двухзначное число </p>
      <p class="welcome_text"> и нажми кнопку! </p>
      <button onclick="formCreate('${numbers_user}')" type="submit" class="btn btn-primary">Я загадал!</button>
    `;
  $("#main_div").append(game);
};