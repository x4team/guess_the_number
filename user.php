<?php
class User { 
    public $numbers = [];
    public $isUserSend = false;
    public $number = 0;
    public function sendNumber($num) 
    {
        array_push($this->numbers, $num); 
    }
}
?>