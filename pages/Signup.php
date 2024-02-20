<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Alcompare\classes\Base\Base;
use Alcompare\classes\Signup\SignupAction;
use Alcompare\util\PHP\ErrorHandler\ErrorHandler;

class Signup extends Base
{
    public function __construct()
    {
        parent::__construct();

        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $signupAction = new SignupAction(new ErrorHandler(), $this->sessionManager);
            $errors = $signupAction->validateInput();
            if (empty($errors)) {
                $signupAction->handleSignup();
            }
        }

        echo $this->render("/classes/Signup/Signup.html.twig", [
            "page" => "Sign up",
            "errors" => $errors,
        ]);

        $errors = [];
    }
}

new Signup();