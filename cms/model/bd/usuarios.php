<?php

/****************************************************************
 * Objetivo: arquivo responsável por manipular dados de usuários
 *                                                        do BD
 * Autor: Leila Rosa
 * Data: 14/04/22
 * Versão: 1.1
 ****************************************************************/

require_once('conexaoMySql.php');

function selectAllUsuarios()
{

    $conexao = abrirConexaoSql();

    $sql = "select * from tblusuarios order by idusuario desc";

    $result = mysqli_query($conexao, $sql);

    if ($result) {

        $cont = 0;

        while ($dadosUsuarios = mysqli_fetch_assoc($result)) {
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
{

    $conexao = abrirConexaoSql();

    $sql = 'delete from tblusuarios where idusuario =' . $id;

    $status = (bool) false;

    if (mysqli_query($conexao, $sql))
        if (mysqli_affected_rows($conexao))
            $status = true;

    fecharConexaoSql($conexao);
    return $status;
}

function insertUsuario($dadosUsuario)
{

    $status = (bool) false;

    $conexao = abrirConexaoSql();

    $sql = "insert into tblusuarios
            (nome, login, senha)
            values(
                '" . $dadosUsuario['nome'] . "',
                '" . $dadosUsuario['login'] . "',
                '" . md5($dadosUsuario['senha']) . "');";

    if (mysqli_query($conexao, $sql))
        if (mysqli_affected_rows($conexao))
            $status = true;

    fecharConexaoSql($conexao);
    return $status;
}

function selectByIdUsuario($id)
{

    $conexao = abrirConexaoSql();

    $sql = "select * from tblusuarios where idusuario =" . $id;

    $result = mysqli_query($conexao, $sql);

    if ($dados = mysqli_fetch_assoc($result)) {
        $arrayUsuarios = array(
            "id"    => $dados['idusuario'],
            "nome"    => $dados['nome'],
            "login"    => $dados['login'],
            "senha"    => $dados['senha'],
        );
    }

    fecharConexaoSql($conexao);

    return $arrayUsuarios;
}

function updateUsuario($dadosUsuario)
{

    $conexao = abrirConexaoSql();

    $status = (bool) false;

    $sql = "update tblusuarios set
                    nome = '" . $dadosUsuario['nome'] . "',
                    login = '" . $dadosUsuario['login'] . "',
                    senha = '" . md5($dadosUsuario['senha']) . "'
                    where idusuario =" . $dadosUsuario['id'];

    if (mysqli_query($conexao, $sql)) {
        if (mysqli_affected_rows($conexao))
            $status = true;
    }

    fecharConexaoSql($conexao);
    return $status;

}
