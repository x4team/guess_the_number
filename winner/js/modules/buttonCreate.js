
// Функция создания кнопок для выбора победителя
let buttonCreate = (name_value, id_value) => {
    btn = document.createElement("BUTTON");
    btn.innerHTML = name_value;
    btn.className = "btn btn-primary";
    document.getElementById("main_div").appendChild(btn);
    if (name_value == "Никто") {
        btn.setAttribute("id", "nobody")
        document.getElementById("nobody").onclick = function () {
            updateCounter(name_value)
        };
    } else {
        btn.setAttribute("id", id_value)
        document.getElementById(id_value).onclick = function () {
            updateCounter(name_value, id_value)
        };
    }

};