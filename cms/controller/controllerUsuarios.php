<?php

/*******************************************************************
 * Objetivo: arquivo responsável por manipular os dados de categoria
 * Autor: Leila Rosa
 * Data: 14/04/22
 * Versão: 1.1
 ******************************************************************/

function adicionarUsuario($dadosUsuario)
{

    if (!empty($dadosUsuario))
        if (!empty($dadosUsuario['txtNome']) || !empty($dadosUsuario['txtLogin']) || !empty($dadosUsuario['txtSenha'])) {

            $arrayDados = array(
                "nome"  => $dadosUsuario['txtNome'],
                "login"  => $dadosUsuario['txtLogin'],
                "senha"  => $dadosUsuario['txtSenha']
            );

            require_once('model/bd/usuarios.php');

            if (insertUsuario($arrayDados))
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

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once('model/bd/usuarios.php');

        if (deletarUsuario($id))
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

function listarUsuarios()
{

    require_once('model/bd/usuarios.php');

    $dadosUsuarios = selectAllUsuarios();

    if (!empty($dadosUsuarios))
        return $dadosUsuarios;
    else
        return false;
}

function buscarUsuario($id)
{

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once('model/bd/usuarios.php');
        $dadosUsuarios = selectByIdUsuario($id);

        if (!empty($dadosUsuarios))
            return $dadosUsuarios;
        else
            return false;
    } else
        return array(
            'idErro'   => 4,
            'message'   => 'Não é possível buscar um registro sem informar um ID válido.'
        );
}

function atualizarUsuario($dadosUsuario, $id)
{

    if(!empty($dadosUsuario)) {
        if(!empty($dadosUsuario['txtNome']) && !empty($dadosUsuario['txtLogin'])) {
            if ($id != 0 && !empty($id) && is_numeric($id)) {

                $arrayDados = array(
                    "id"    => $id,
                    "nome"  => $dadosUsuario['txtNome'],
                    "login" => $dadosUsuario['txtLogin'],
                    "senha" => $dadosUsuario['txtSenha']
                );

                require_once('model/bd/usuarios.php');

                if(updateUsuario($arrayDados))
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
