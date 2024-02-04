<?php
namespace Alcompare;
require_once '../vendor/autoload.php';

use Alcompare\classes\Base\Base;

class About extends Base {
    public function __construct() {
        parent::__construct();
        echo $this->render("/templates/test.html.twig", [
            "trym" => "homo",
            "daniel" => "sykt kul",
            "marcus" => "autist",
            "title" => $this->getTitle(),
        ]);
    }

    private function getTitle() {
        return "TITTEL";
    }
}

new About();
