<?php

require __DIR__ . "/../vendor/autoload.php";

// corretores e usuarios
$lead = new \ElxDigital\Vista\Services\Realtor('c9fdd79584fb8d369a6a579af1a8f681');
$lead->setIsSandbox();
$properties->getRealtor();
var_dump($properties->getCallback());
return;