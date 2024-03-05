<?php

namespace Alcompare;

require_once $_SERVER['DOCUMENT_ROOT'].'/config/setup.php';

use Alcompare\classes\Base\Base;

/**
 * Class Contact
 *
 * Represents the contact page of the website.
 */
class Contact extends Base
{
    /**
     * Constructs a new Contact object.
     */
    public function __construct()
    {
        parent::__construct();

        // Render the contact page.
        if (isset($_SESSION["userId"])) {
            echo $this->render("/classes/Contact/Contact.html.twig", [
                "page" => "Contact",
            ]);
        } else {
            header("Location: /pages/Login.php");
        }
    }
}

new Contact();
