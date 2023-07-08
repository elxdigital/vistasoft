<?php

require __DIR__ . "/../vendor/autoload.php";

// puxa a listagem de imobiliarias
$realEstate = new \ElxDigital\Vista\Services\RealEstate('c9fdd79584fb8d369a6a579af1a8f681');
$realEstate->setIsSandbox();
$realEstate->getRealEstate();
var_dump($realEstate->getCallback());
return;