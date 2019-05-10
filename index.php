<?php

require_once "config.php";

$cliente = new Cliente();

$cliente->setNome("Jose da Silva");
$cliente->setNasc('27/04/1995');

$cliente->insert();

