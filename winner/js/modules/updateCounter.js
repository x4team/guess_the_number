// Обновление счетчика угадываний и состояние(флага) отправки
const updateCounter = (person_name, person_id) => {
    if (person_name == 'Никто') {
        $.ajax({
            type: 'POST',
            url: "nobody_reload.php",
            success: function (data) {
                location.reload();
            }
        });
    } else {
        // Запрос на изменение данных в сессии через ajax	
        $.ajax({
            type: 'POST',
            url: "update_counter.php",
            data: {
                data: `${person_name}`
            },
            success: function (data) {
                location.reload();
            }
        });
    }
};