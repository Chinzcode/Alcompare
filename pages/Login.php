<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Alcompare\classes\Base\Base;
use Alcompare\classes\Login\LoginAction;
use Alcompare\util\PHP\ErrorHandler\ErrorHandler;

class Login extends Base
{
    public function __construct()
    {
        parent::__construct();

        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $loginAction = new LoginAction(new ErrorHandler(), $this->sessionManager);
            $errors = $loginAction->validateInput();
            if (empty($errors)) {
                $loginAction->handleLogin();
            }
        }

        echo $this->render("/classes/Login/Login.html.twig", [
            "page" => "Log in",
            "errors" => $errors,
        ]);

        $errors = [];
    }
}

new Login();
