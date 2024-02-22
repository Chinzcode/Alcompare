<?php

namespace Alcompare;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Alcompare\classes\Base\Base;

class About extends Base
{
    public function __construct()
    {
        parent::__construct();
        echo $this->render("/classes/About/About.html.twig", [
            "page" => "About",
        ]);
    }
}

new About();
