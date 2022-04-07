<?php

/*************************************************************
 * Objetivo: arquivo responsável por manipular os dados de contato
 * Obs.: também fará a ponte entre view e model
 * Autor: Leila Rosa
 * Data: 31/03/22
 * Versão: 1.1
 *************************************************************/


function listarContatos()
{
    require_once('model/bd/contatos.php');

    $dados = selectAllContatos();

    if (!empty($dados))
        return $dados;
    else
        return false;
}

function deletarContato($id)
{


    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once('model/bd/contatos.php');

        if (excluirContato($id))
            return true;
        else
            return array(
                'idErro'        => 5,
                'message'       => 'O banco de dados não pode excluir seu registro.'
            );
    } else
        return array(
            'idErro'        => 6,
            'message'       => 'Não é possível excluir um registro sem informar um ID válido.'
        );
}
