<?php
class Storage
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            $this->initStorage();
        }
    }

    protected function initStorage()
    {
        session_start();
    }

    public function setStorageId($id, $value)
    {
        if (!isset($_SESSION[$id])) {
            $_SESSION[$id] = $value;
        }
    }

    public function getStorageId($Id)
    {
        return $_SESSION[$Id];
    }
}
