<?php
class Person { 
    public $counter = 0;
    public $num = 0;
    public $numbers_history = [];
    public $guess_rating = 0;

    // Метод 
    public function guessMethod(){
        // Угадываем число (рандомная генерация)
        $number = mt_rand(10,99);
        $this->num = $number;
        // Отправляем число в массив "история чисел"
        array_push($this->numbers_history, $number); 
    }
    // Метод обновления данных в счетчике по кол-ву угадываний
    public function counterMethod(){
        $this->counter += 1;
    }
}
?>
