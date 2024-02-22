<?php

namespace Pages;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Alcompare\classes\Base\Base;

class Home extends Base
{
    public function __construct()
    {
        parent::__construct();

        echo $this->render("/classes/Home/Home.html.twig", [
            "title" => $this->getTitle(),
        ]);
    }

    private function getTitle()
    {
        return "Home";
    }
}

new Home();
