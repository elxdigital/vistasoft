<?php

require __DIR__ . "/../vendor/autoload.php";

// puxa todos os imóveis
$realty = new \ElxDigital\Vista\Services\Realty('c9fdd79584fb8d369a6a579af1a8f681');
$realty->setIsSandbox();
$realty->setPagination(1, 50); 
$realty->getPropertiesDays(5);
var_dump($realty->getCallback());

// lista campos liberados dos imóveis
//$realty->getListFields();
//var_dump($realty->getCallback());


return;