<?php

/*******************************************************************
 * Objetivo: arquivo responsável por manipular os dados de categoria
 * Autor: Leila Rosa
 * Data: 14/04/22
 * Versão: 1.0
 ******************************************************************/

function adicionarUsuario($dadosUsuario)
{

    if(!empty($dadosUsuario))
        if (!empty($dadosUsuario['txtNome']) || !empty($dadosUsuario['txtLogin']) || !empty($dadosUsuario['txtSenha'])) {

            $arrayDados = array (
                "nome"  => $dadosUsuario['txtNome'],
                "login"  => $dadosUsuario['txtLogin'],
                "senha"  => $dadosUsuario['txtSenha']
            );

            require_once('model/bd/usuarios.php');

            if(insertUsuario($arrayDados))
                return true;
            else
                return array(
                    'idErro' => 1,
                    'message' => 'Não foi possivel inserir os dados no Banco de Dados'
                );
        } else 
            return array(
                'idErro' => 2,
                'message' => 'Existem campos obrigatórios que não foram preenchidos.'
            );

}

function excluirUsuario($id)
{


    
}

function listarUsuarios()
{

    require_once('model/bd/usuarios.php');

    $dadosUsuarios = selectAllUsuarios();

    if(!empty($dadosUsuarios))
        return $dadosUsuarios;
    else
        return false;

}

function buscarUsuario($id)
{}

function atualizarUsuario($dadosUsuario, $id)
{}
