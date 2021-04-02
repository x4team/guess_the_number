let continueGame = (numbers) => {
        
    let game = `
      <h3>Продолжаем играть!</h3> 
      <p class="welcome_text"> Загадай двухзначное число </p>
      <p class="welcome_text"> и нажми кнопку! </p>
      <button onclick="formCreate('${numbers}')" type="submit" class="btn btn-primary">Я загадал!</button>
    `;
      $("#main_div").append(game);
  };