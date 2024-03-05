<?php

namespace Alcompare;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Alcompare\classes\Base\Base;

/**
 * Class About
 *
 * Represents the about page of the website.
 */
class About extends Base
{
    /**
     * Constructs a new About object.
     */
    public function __construct()
    {
        parent::__construct();

        // Render the about page.
        if (isset($_SESSION["userId"])) {
            echo $this->render("/classes/About/About.html.twig", [
                "page" => "About",
            ]);
        } else {
            header("Location: /pages/Login.php");
        }
    }
}

new About();
