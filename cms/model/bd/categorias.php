<?php


/*************************************************************
 * Objetivo: arquivo responsável por manipular os dados de categoria
 *                                                             do BD
 * Autor: Leila Rosa
 * Data: 07/04/22
 * Versão: 1.4
 *************************************************************/

require_once('conexaoMySql.php');

function selectAllCategorias()
{

    $conexao = abrirConexaoSql();

    $sql = "select * from tblcategorias order by idcategoria desc";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;

        while ($dadosCategorias = mysqli_fetch_assoc($result)) {

            $arrayCategorias[$cont] = array(
                'id'    => $dadosCategorias['idcategoria'],
                'nome'  => $dadosCategorias['nome']
            );
            $cont++;
        }

        fecharConexaoSql($conexao);

        return $arrayCategorias;
    } else {
        fecharConexaoSql($conexao);
        return array(
            'idErro'    => 7,
            'message'   => 'Objeto não foi encontrado no banco.'
        );
    }
}

function deletarCategoria($id)
{

    $conexao = abrirConexaoSql();

    $sql = 'delete from tblcategorias where idcategoria =' . $id;

    $status = (bool) false;

    if (mysqli_query($conexao, $sql))
        if (mysqli_affected_rows($conexao))
            $status = true;

    fecharConexaoSql($conexao);
    return $status;
}

function insertCategoria($dadosCategorias)
{

    $status = (bool) false;

    $conexao = abrirConexaoSql();

    $sql = "insert into tblcategorias(nome)
            values('" . $dadosCategorias['nome'] . "');";

    if (mysqli_query($conexao, $sql))
        if (mysqli_affected_rows($conexao))
            $status = true;

    fecharConexaoSql($conexao);
    return $status;
}

function selectByIdCategoria($id) {
    
}