<?php

/*************************************************************
 * Objetivo: arquivo responsável por manipular os dados de contatos
 *                                                          do BD
 * Autor: Leila Rosa
 * Data: 29//05/22
 * Versão: 1.0
 *************************************************************/

 require_once("conexaoMySql.php");

function selectAllProdutosCategorias() {

    $conexao = abrirConexaoSql();

    $sql = "select * from tblProdutos_Categorias order by id desc;";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;

        while($rsDados = mysqli_fetch_assoc($result))
        {
            $arrayDados[$cont] = array(
                "id"            => $rsDados['id'],
                "idcategoria"   => $rsDados['idCategoria'],
                "idproduto"     => $rsDados['idProduto']
             );

            $cont++;
        }

        fecharConexaoSql($conexao);

        return $arrayDados;
    }

}

function insertProdutosCategorias($dados) {

    $status = (bool) false;

    $conexao = abrirConexaoSql();

    $sql = "insert into tblProdutos_Categorias(idProduto, idCategoria) values
        ('" . $dados['idproduto'] . "',
        '" . $dados['idcategoria'] . "')";

    if (mysqli_query($conexao, $sql)) {
        if(mysqli_affected_rows($conexao))
            $status = true;
    }

    fecharConexaoSql($conexao);
    return $status;

}

function deleteProdutosCategorias($id) {


    $conexao = abrirConexaoSql();

    $status = (bool) false;

    $sql = "delete from tblProdutos_Categorias where id =" . $id;

    if (mysqli_query($conexao, $sql)) 
        if (mysqli_affected_rows($conexao))
            $status = true;
    

    fecharConexaoSql($conexao);
    return $status;

}

function selectByIdProdutosCategorias($id) {

     
    $conexao = abrirConexaoSql();

    $sql = "select * from tblProdutos_Categorias where id =". $id;

    $result = mysqli_query($conexao, $sql);

    if ($result) {
        if($rsDados = mysqli_fetch_assoc($result)) {
            $arrayDados = array(
            "id"            => $rsDados['id'],
            "idcategoria"   => $rsDados['idCategoria'],
            "idproduto"     => $rsDados['idProduto']
            );
        }

        fecharConexaoSql($conexao);
        return $arrayDados;
    }

}

function updateProdutosCategorias($dados) {

    $status = (bool) false;

    $conexao = abrirConexaoSql();

    $sql = "update tblProdutos_Categorias set
                    idproduto = '" . $dados['idproduto'] . "',
                    idcategoria = '" . $dados['idcategoria'] . "'
                    where id=". $dados['id'];

    if (mysqli_query($conexao, $sql))
        if (mysqli_affected_rows($conexao))
            $status = true;

    fecharConexaoSql($conexao);

    return $status;

}

?>
