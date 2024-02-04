<?php
require_once 'vendor/autoload.php';
use Alcompare\util\Twig\TwigEngine;

$twig = TwigEngine::getInstance();
echo $twig->render("/templates/frontpage.html.twig");
