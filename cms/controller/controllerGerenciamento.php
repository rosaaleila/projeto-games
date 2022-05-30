<?php

/*******************************************************************
 * Objetivo: arquivo responsável por manipular os dados de categoria
 * Obs.: também fará a ponte entre view e model
 * Autor: Leila Rosa
 * Data: 29/05/22
 * Versão: 1.0
 ******************************************************************/

function adicionarProdutoCategoria($dados){

    if(!empty($dados)) {

        if ($dados['produto'] != 0 && $dados['categoria'] != 0) {

            $arrayGerenciamento = array(
                'idproduto' => $dados['produto'],
                'idcategoria' => $dados['categoria']
            );

            require_once('model/bd/produtos-categorias.php');

            if (insertProdutosCategorias($arrayGerenciamento))
                return true;
            else
                return array();
        } else
            return array();

    }

}

function listarProdutoCategoria(){

    require_once('model/bd/produtos-categorias.php');

    $dados = selectAllProdutosCategorias();

    if (!empty($dados))
        return $dados;
    else
        return false;

}

function excluirProdutoCategoria($id){

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once('model/bd/produtos-categorias.php');

        if (deleteProdutosCategorias($id))
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

function buscarProdutoCategoria($id){

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once('model/bd/produtos-categorias.php');

        $dados = selectByIdProdutosCategorias($id);

        if (!empty($dados))
            return $dados;
        else
            return false;
    } else
        return array(
            'idErro'   => 4,
            'message'   => 'Não é possível buscar um registro sem informar um ID válido.'
        );

}

function atualizarProdutoCategoria($dados, $id){

    if (!empty($dados)) {
        if ($dados['produto'] != 0 && $dados['categoria'] != 0) {
            if ($id != 0 && !empty($id) && is_numeric($id)) {

                $arrayDados = array(
                    "id"    => $id,
                    "idcategoria"  => $dados['categoria'],
                    "idproduto"  => $dados['produto']
                );

                require_once('model/bd/produtos-categorias.php');

                if (updateProdutosCategorias($arrayDados))
                    return true;
                else
                    return array(
                        'idErro' => 1,
                        'message' => 'Não foi possivel atualizar os dados no Banco de Dados.'
                    );
            } else
                return array(
                    'idErro'    => 4,
                    'message'   => 'Não é possível editar um registro com ID inválido.'
                );
        } else
            return array(
                'idErro' => 2,
                'message' => 'Existem campos obrigatórios que não foram preenchidos.'
            );
    } 

}

?>