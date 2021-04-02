<?php
class User { 
    public $numbers = [];
    public $isUserSend = false;

    public function sendNumber($num) 
    {
        array_push($this->numbers, $num); 
    }
}
?>