<?php

namespace Alcompare;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Alcompare\classes\Base\Base;

class Contact extends Base
{
    public function __construct()
    {
        parent::__construct();
        echo $this->render("/classes/Contact/Contact.html.twig", [
            "page" => "Contact",
        ]);
    }
}

new Contact();
