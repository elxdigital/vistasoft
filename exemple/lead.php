<?php

require __DIR__ . "/../vendor/autoload.php";

// insere um lead no CRM vista
$lead = new \ElxDigital\Vista\Services\Realty('c9fdd79584fb8d369a6a579af1a8f681');
$lead->setIsSandbox();

$setLead = new \ElxDigital\Vista\Data\Lead();
$setLead->setName('Nome teste');
$setLead->setEmail('teste@teste.com.br');
$setLead->setFone('99 99999.6655');
$setLead->setFinalityBuy();
$setLead->setMensage('Mensagem teste');
$setLead->setChannel('Site');
$setLead->setRealState('1');
$setLead->setRealtor(1);
$setLead->setRealty(1);

$lead->setLeads($setLead);
$lead->sendLead();
var_dump($lead);
return;