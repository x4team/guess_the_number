<?php
class Person { 
    public $counter = 0;
    public $num = 0;

    public function guessMethod(){
        $number = mt_rand(10,99);
        $this->num = $number;
    }
    public function counterMethod(){
        $this->counter += 1;
    }
}
?>
