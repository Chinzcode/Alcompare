<?php

use Alcompare\util\Twig\TwigEngine;

$twig = TwigEngine::getInstance();
echo $twig->render("/templates/standard.html.twig");
