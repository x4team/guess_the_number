// Функция создания параграфа
let paragraphCreate = (text) => {
    let para = document.createElement("P");
    para.innerText = text;
    para.className = "answer";
    document.getElementById("main_div").appendChild(para);
}