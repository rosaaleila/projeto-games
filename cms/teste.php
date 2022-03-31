<?php

require_once('controller/controllerContatos.php');

$listContato = listarContatos();

foreach ($listContato as $item) {
    echo($item['nome'] . "<br>");
    echo($item['email'] . "<br>");
    echo($item['mensagem'] . "<br>");
}



?>