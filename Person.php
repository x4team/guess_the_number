<?php
class Person
{
    public $name = '';
    public $id = '';
    public $counter = 0;
    public $num = 0;
    public $numbers_history = [];
    public $guess_rating = 0;

    public function setName($string)
    {
        $this->name = $string;
    }
    // Метод угадывания
    public function guessMethod()
    {
        // Рандомная генерация чисел
        $number = mt_rand(10, 99);
        $this->num = $number;
        // Отправляем число в массив "история чисел"
        array_push($this->numbers_history, $number);
    }
    // Метод обновления данных в счетчике по кол-ву угадываний
    public function counterMethod()
    {
        $this->counter += 1;
    }
}
