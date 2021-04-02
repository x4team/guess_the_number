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