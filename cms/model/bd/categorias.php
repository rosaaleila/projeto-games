<?php


/*************************************************************
 * Objetivo: arquivo responsável por manipular os dados de categoria
 *                                                             do BD
 * Autor: Leila Rosa
 * Data: 07/04/22
 * Versão: 1.0
 *************************************************************/

require_once(conexaoMySql());

function selectAllCategorias()
{

    $conexao = abrirConexaoSql();

    $sql = "select * from tblcategorias order by idcategoria desc";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;

        while ($dadosCategorias = mysqli_fetch_assoc($result)) {

            $arrayCategorias[$cont] = array (
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

function excluirCategoria()
{}


function insertCategoria($dadosCategorias)
{

    $status = (bool) false;

    $conexao = abrirConexaoSql();

    $sql = "insert into tblcategorias(nome)
            values('" . $dadosCategorias['nome'] . "';";

    if(mysqli_query($conexao, $sql))
        if(mysqli_affected_rows($conexao))
            $status = true;

    fecharConexaoSql($conexao);
    return $status;

}