<?php 

/***********************************************************************
 * Objetivo: Arquivo responsável por manipular os dados dentro do BD
 * Autor: Leila
 * Data: 26/04/2022
 * Versão: 1.0
 ***********************************************************************/

 require_once('conexaoMySql.php');

 function insertProduto($dadosProduto)
 {

    $status = (bool) false;

    $conexao = abrirConexaoSql();

    $sql = "insert into tblprodutos
                    (nome,
                    descricao,
                    preco,
                    promocao,
                    imagem)
                    values
                    ('" . $dadosProduto['nome'] . "',
                    '" . $dadosProduto['descricao'] . "',
                    '" . $dadosProduto['preco'] . "',
                    '" . $dadosProduto['promocao'] . "',
                    '" . $dadosProduto['foto'] . "')";

    if (mysqli_query($conexao, $sql)) {
        if(mysqli_affected_rows($conexao))
            $status = true;
    }

    fecharConexaoSql($conexao);
    return $status;

 }

 function deleteProduto($id)
 {

    $conexao = abrirConexaoSql();

    $status = (bool) false;

    $sql = "delete from tblprodutos where idproduto =" . $id;

    if (mysqli_query($conexao, $sql)) 
        if (mysqli_affected_rows($conexao))
            $status = true;
    

    fecharConexaoSql($conexao);
    return $status;

 }

 function selectAllProdutos()
 {

    $conexao = abrirConexaoSql();

    $sql = "select * from tblprodutos order by idproduto desc";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;

        while($rsDados = mysqli_fetch_assoc($result))
        {
            $arrayDados[$cont] = array(
                "id"            => $rsDados['idproduto'],
                "nome"          => $rsDados['nome'],
                "descricao"     => $rsDados['descricao'],
                "preco"         => $rsDados['preco'],
                "promocao"      => $rsDados['promocao'],
                "foto"          => $rsDados['imagem']
             );
            $cont++;
        }

        fecharConexaoSql($conexao);

        return $arrayDados;

    }

 }

 function selectByIdProduto($id)
 {
     
    $conexao = abrirConexaoSql();

    $sql = "select * from tblprodutos where idproduto =". $id;

    $result = mysqli_query($conexao, $sql);

    if ($result) {
        if($rsDados = mysqli_fetch_assoc($result)) {
            $arrayDados = array(
                "id"            => $rsDados['idproduto'],
                "nome"          => $rsDados['nome'],
                "descricao"     => $rsDados['descricao'],
                "preco"         => $rsDados['preco'],
                "foto"          => $rsDados['imagem'],
                "promocao"      => $rsDados['promocao'],
            );
        }

        fecharConexaoSql($conexao);
        return $arrayDados;
    }

 }

 function updateProduto($dadosProduto)
 {

    $status = (bool) false;

    $conexao = abrirConexaoSql();

    $sql = "update tblprodutos set
                    nome = '" . $dadosProduto['txtNome'] . "',
                    descricao = '" . $dadosProduto['txtDescricao'] . "',
                    preco = '" . $dadosProduto['txtPreco'] . "',
                    promocao = '" . $dadosProduto['txtPromocao'] . "'
                    where idproduto=". $id;

    if (mysqli_query($conexao, $sql))
        if (mysqli_affected_rows($conexao))
            $status = true;

        
    fecharConexaoSql($conexao);

    return $status;

 }


?>