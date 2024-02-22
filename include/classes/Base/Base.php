<?php

namespace Alcompare\classes\Base;

require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use Alcompare\util\Twig\TwigEngine;
use Alcompare\util\PHP\SessionManager\SessionManager;

class Base
{
    private $twig;
    protected $sessionManager;

    public function __construct()
    {
        $this->twig = TwigEngine::getInstance();
        $this->sessionManager = new SessionManager();
        $this->twig->addGlobalVariable("isUserLoggedIn", $_SESSION["userId"]);
        $this->twig->addGlobalVariable("username", $_SESSION["username"]);
    }
    public function render(string $name, array $context = array())
    {
        return $this->twig->render($name, $context);
    }
}
