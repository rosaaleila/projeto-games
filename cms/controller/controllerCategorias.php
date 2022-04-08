<?php

/*******************************************************************
 * Objetivo: arquivo responsável por manipular os dados de categoria
 * Obs.: também fará a ponte entre view e model
 * Autor: Leila Rosa
 * Data: 07/04/22
 * Versão: 1.3
 ******************************************************************/

function adicionarCategoria($dadosCategoria)
{

    if (!empty($dadosCategoria)) {
        if (!empty($dadosCategoria['txtNome'])) {

            $arrayCategoria = array("nome" => $dadosCategoria['txtNome']);

            require_once('model/bd/categorias.php');

            if (insertCategoria($arrayCategoria))
                return true;
            else
                return array(
                    'idErro'    => 8,
                    'message'   => 'Não foi possível inserir os dados no BD.'
                );
        } else
            return array(
                'idErro'    => 9,
                'message'   => 'Existem campos vazios.'
            );
    }
}

function excluirCategoria($id)
{

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once('model/bd/categorias.php');

        if (deletarCategoria($id))
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

function listarCategorias()
{

    require_once('model/bd/categorias.php');

    $dadosCategoria = selectAllCategorias();

    if (!empty($dadosCategoria))
        return $dadosCategoria;
    else
        return false;
}

function buscarCategoria($id)
{

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once('model/bd/categorias.php');

        $dadosCategoria = selectByIdCategoria($id);

        if (!empty($dadosCategoria))
            return $dadosCategoria;
        else
            return false;
    } else
        return array(
            'idErro'   => 4,
            'message'   => 'Não é possível buscar um registro sem informar um ID válido.'
        );
        
}
