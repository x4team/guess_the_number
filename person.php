<?php
class Person { 
    public $counter = 0;
    public $num = 0;

    public function guess_method(){
        $number = mt_rand(10,99);
        $this->num = $number;
    }
    public function counter_method(){
        $this->counter += 1;
    }
}
?>
