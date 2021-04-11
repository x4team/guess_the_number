<?php
class Storage
{
    public function __construct()
    {
        if (session_status() < 2) {
            $this->initStorage();
        }
    }

    protected function initStorage()
    {
        session_start();
    }

    public function setStorageId(string $id = "", $value)
    {
        if (!isset($_SESSION[$id])) {
            $_SESSION[$id] = $value;
        }
    }

    public function getStorageId(string $Id)
    {
        return $_SESSION[$Id];
    }
}
