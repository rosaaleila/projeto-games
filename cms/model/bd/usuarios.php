<?php

/****************************************************************
 * Objetivo: arquivo responsável por manipular dados de usuários
 *                                                        do BD
 * Autor: Leila Rosa
 * Data: 14/04/22
 * Versão: 1.0
 ****************************************************************/

require_once('conexaoMySql.php');

function selectAllUsuarios()
{

    $conexao = abrirConexaoSql();

    $sql = "select * from tblusuarios order by idusuario desc";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;

        while($dadosUsuarios = mysqli_fetch_assoc($result)) {
            $arrayUsuarios[$cont] = array(
                "id"        => $dadosUsuarios['idusuario'],
                "nome"      => $dadosUsuarios['nome'],
                "login"     => $dadosUsuarios['login'],
                "senha"     => $dadosUsuarios['senha']
            );
            $cont++;
        }

        fecharConexaoSql($conexao);

        return $arrayUsuarios;

    } else {
        fecharConexaoSql($conexao);
        return array(
            'idErro'    => 7,
            'message'   => 'Objeto não foi encontrado no banco.'
        );
    }

}

function deletarUsuario($id)
{}

function insertUsuario($dadosUsuario)
{

    $status = (bool) false;

    $conexao = abrirConexaoSql();

    $sql = "insert into tblusuarios
            (nome, login, senha)
            values(
                '" . $dadosUsuario['nome'] . "',
                '" . $dadosUsuario['login'] . "',
                '" . $dadosUsuario['senha'] . "');";

    if(mysqli_query($conexao, $sql))
        if(mysqli_affected_rows($conexao))
                $status = true;
    
    fecharConexaoSql($conexao);
    return $status;

}

function selectByIdUsuario($id)
{}

function updateUsuario($dadosUsuario)
{}
