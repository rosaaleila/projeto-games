<?php

/*************************************************************
 * Objetivo: arquivo responsável por manipular os dados de contato
 * Obs.: também fará a ponte entre view e model
 * Autor: Leila Rosa
 * Data: 31/03/22
 * Versão: 1.0
 *************************************************************/


function listarContatos() 
{
    require_once('model/bd/contatos.php');

    $dados = selectAllContatos();

    if(!empty($dados))
        return $dados;
    else
        return false;

}


?>