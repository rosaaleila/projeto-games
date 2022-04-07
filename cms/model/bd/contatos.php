<?php

/*************************************************************
 * Objetivo: arquivo responsável por manipular os dados do BD
 * Autor: Leila Rosa
 * Data: 31/03/22
 * Versão: 1.0
 *************************************************************/

 require_once("conexaoMySql.php");

 // função para listar todos os contatos no BD
 function selectAllContatos()
 {
    $conexao = abrirConexaoSql();

    $sql = "select * from tblcontatos order by idcontato desc";

    // enviando script pro BD
    $result = mysqli_query($conexao, $sql);

    if($result) {
        $cont = 0;

        while ($dados = mysqli_fetch_assoc($result)) {
            $arrayDados[$cont] = array(
                "id"        => $dados['idcontato'],
                "nome"      => $dados['nome'],
                "email"     => $dados['email'],
                "mensagem"  => $dados['mensagem']
            );
            $cont++;
        }

        fecharConexaoSql($conexao);

        return $arrayDados;
    } else {
        fecharConexaoSql($conexao);
        return array(
            'idErro'    => 1,
            'message'   => 'Não foi encontrado no banco'
        );
    }

 }

 function excluirContato($id)
 {

    $conexao = abrirConexaoSql();

    $sql = "delete from tblcontatos where idcontato =" . $id;

    $status = (bool) false;

    // verificando se o script deu certo
    if (mysqli_query($conexao, $sql)) {

        if(mysqli_affected_rows($conexao))
            $status = true;
    
        }

    fecharConexaoSql($conexao);
    return $status;

 }
