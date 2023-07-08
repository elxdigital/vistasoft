<?php

require __DIR__ . "/../vendor/autoload.php";

// puxa a listagem de campos do imóvel
$properties = new \ElxDigital\Vista\Services\Realty('c9fdd79584fb8d369a6a579af1a8f681');
$properties->setIsSandbox();
$properties->getListFields();
var_dump($properties->getCallback());
return;

// puxa a listagem de imoveis
$properties = new \ElxDigital\Vista\Services\Realty('c9fdd79584fb8d369a6a579af1a8f681');
$properties->setIsSandbox();
$properties->setPagination(1, 50); 
$properties->getProperties();
var_dump($properties->getCallback());
return;