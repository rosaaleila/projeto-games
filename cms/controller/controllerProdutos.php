<?php

/***********************************************************************
 * Objetivo: Arquivo responsável pela manipulação de dados de contatos.
 *  Obs:. Este arquivo fará a ponte entre a View e a Model
 * Autora: Leila
 * Data: 26/04/2022
 * Versão: 1.0
 ***********************************************************************/

require_once('model/bd/conexaoMySql.php');

function inserirProduto ($dadosProduto, $file)
{

    $nomeFoto = (string) null;

    if (!empty($dadosProduto)) {
        if (!empty($dadosProduto['txtNome']) && !empty($dadosProduto['txtDescricao'])) {
            if($file['fleFoto']['name'] != null) {
                
                require_once('modulo/upload.php');

                $nomeFoto = uploadFile($file['fleFoto']);

                if(is_array($nomeFoto))
                    return $nomeFoto;
            } else {

                $nomeFoto = "semfoto.jpg";

            }

                $arrayDados = array(
                    "nome"      => $dadosProduto['txtNome'],
                    "descricao" => $dadosProduto['txtDescricao'],
                    "preco"     => $dadosProduto['txtPreco'],
                    "promocao"  => $dadosProduto['txtPromocao'],
                    "foto"      => $nomeFoto
                );
    
                require_once('model/bd/produtos.php');
    
                if(insertProduto($arrayDados)) 
                    return true;
                else
                    return array(
                        'idErro' => 1,
                        'message' => 'Não foi possivel inserir os dados no Banco de Dados.');

        } else
            return array(
                'idErro' => 2,
                'message' => 'Existem campos obrigatórios que não foram preenchidos.');

    }
}

function atualizarProduto ($dadosProduto, $arrayDados)
{

    $id = $arrayDados['id'];
    $foto = $arrayDados['foto'];
    $file = $arrayDados['file'];

    if (!empty($dadosProduto)) {
        if (!empty($dadosProduto['txtNome']) && !empty($dadosProduto['txtDescricao']) && !$file) {/*O que fica no colchete é o 'name' da input*/
            if (!empty($id) && is_numeric($id) && $id != 0) {
                 
                $arrayDados = array(
                    "id"        => $id,
                    "nome"      => $dadosProduto['txtDescricao'],
                    "preco"     => $dadosProduto['txtPreco'],
                    "promocao"  => $dadosProduto['txtPromocao'],
                );

                require_once('model/bd/contato.php');

                if (updateContato($arrayDados))
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
        } else {
            return array(
                'idErro' => 2,
                'message' => 'Existem campos obrigatórios que não foram preenchidos.'
            );
        }
    }
    
}

function excluirProduto ($dadosProduto)
{

    $id = $dadosProduto['id'];
    
    $foto = $dadosProduto['foto'];

    if ($id != 0 && !empty($id) && is_numeric($id)) {
    
        require_once('model/bd/produtos.php');
        require_once('modulo/config.php'); 

        if(deleteProduto($id)) {
            unlink(DIRETORIO_FILE_UPLOAD.$foto);
            return true;
        } else
            return array(
                'idErro'   => 3,
                'message'   => 'O banco de dados não pode excluir o registro.'
            );
    
    } else 
        return array(
            'idErro'   => 4,
            'message'   => 'Não é possível excluir um registro sem informar um ID válido.'
        );

}

function listarProdutos()
{

    require_once('model/bd/produtos.php');

    $dados = selectAllProdutos();

    if (!empty($dados))
        return $dados;
    else
        return false;

}

function buscarProduto($id)
{

    if ($id != 0 && !empty($id) && is_numeric($id)) {

        require_once('model/bd/produtos.php');
        
        $dados = selectByIdProduto($id);

        if (!empty($dados))
            return $dados;
        else
            return false;
    } else {
        return array(
            'idErro'   => 4,
            'message'   => 'Não é possível buscar um registro sem informar um ID válido.'
        );
    }

}

?>