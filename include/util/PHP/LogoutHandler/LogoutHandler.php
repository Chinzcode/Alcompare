<?php

namespace Alcompare\util\PHP\LogoutHandler;

class LogoutHandler
{
    public function __construct()
    {
        $this->handleLogout();
    }
    public static function handleLogout(): void
    {
        session_start();
        session_unset();
        session_destroy();

        header("location: /pages/Login.php");
        die();
    }
}

new LogoutHandler();
