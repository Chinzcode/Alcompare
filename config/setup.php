<?php

declare(strict_types=1);
require_once $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use Alcompare\util\Twig\TwigEngine;

$twig = TwigEngine::getInstance();
echo $twig->render("/templates/frontpage.html.twig");
