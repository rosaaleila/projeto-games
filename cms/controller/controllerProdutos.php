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

    $nomeFoto = (string) "semfoto/semfoto.jpg";
    $statusDestaque = (int) 0;

    if (!empty($dadosProduto)) {
        if (!empty($dadosProduto['txtNome']) && !empty($dadosProduto['txtDescricao']) && !empty($dadosProduto['txtPreco'])) {
            
            if($file['fleFoto']['name'] != null) {
                
                require_once('modulo/upload.php');

                $nomeFoto = uploadFile($file['fleFoto']);

                if(is_array($nomeFoto))
                    return $nomeFoto;
            }

            if (isset($dadosProduto['chkDestaque']))
                $statusDestaque = 1;

                $arrayDados = array(
                    "nome"      => $dadosProduto['txtNome'],
                    "descricao" => $dadosProduto['txtDescricao'],
                    "preco"     => $dadosProduto['txtPreco'],
                    "promocao"  => $dadosProduto['txtPromocao'],
                    "destaque"  => $statusDestaque,
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
    $destaque = (int) 0;

    if (!empty($dadosProduto)) {
        if (!empty($dadosProduto['txtNome']) && !empty($dadosProduto['txtDescricao'])) {/*O que fica no colchete é o 'name' da input*/
            if (!empty($id) && is_numeric($id) && $id != 0) {
                 

                if($file['fleFoto']['name'] != null) {

                    require_once('modulo/upload.php');

                    $novaFoto = uploadFile($file['fleFoto']);

                } else {

                    $novaFoto = $foto;
                
                }

                if (isset($dadosProduto['chkDestaque'])) {
                    $destaque = 1;
                }

                $arrayDados = array(
                    "id"        => $id,
                    "nome"      => $dadosProduto['txtNome'],
                    "descricao" => $dadosProduto['txtDescricao'],
                    "preco"     => $dadosProduto['txtPreco'],
                    "promocao"  => $dadosProduto['txtPromocao'],
                    "destaque"  => $destaque,
                    "foto"      => $novaFoto
                );

                require_once('model/bd/produtos.php');

                if (updateProduto($arrayDados)) {
                    if ($novaFoto != $foto)
                        unlink(DIRETORIO_FILE_UPLOAD.$foto);
                    return true;
                } else
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

            if($foto != null && $foto != "semfoto/semfoto.jpg") {
                if(unlink(DIRETORIO_FILE_UPLOAD.$foto))
                    return true;
                else
                    return array(
                        'idErro'    => 5, 
                        'message'   => "A imagem não pode ser excluída no."
                    );

            } else
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
/*     $statusDestaque = $dados['destaque']; */

    if (!empty($dados)) {
        /* if ($dados['destaque'] == 1)
            $statusDestaque = true;
        else
            $statusDestaque = false; */
        
        /* $dados['destaque'] = $statusDestaque; */
        return $dados;
    } else
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