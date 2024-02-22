<?php

namespace Alcompare\util\PHP\LogoutHandler;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

class LogoutHandler
{
    public function __construct()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->handleLogout();
        }
    }

    public function handleLogout(): void
    {
        session_start();
        session_unset();
        session_destroy();

        header("location: /pages/Login.php");
        die();
    }
}

new LogoutHandler();
