<?php

/*******************************************************************
 * Objetivo: arquivo responsável por manipular os dados de categoria
 * Obs.: também fará a ponte entre view e model
 * Autor: Leila Rosa
 * Data: 07/04/22
 * Versão: 1.0
 ******************************************************************/

function inserirCategoria($dadosCategoria)
{

    if(!empty($dadosCategoria)) {
        if(!empty($dadosCategoria['nome'])) {

            $arrayCategoria = array( "nome" => $dadosCategoria['txtNome'] );
        
            require_once('../model/bd/categorias.php');

            if(insertCategoria($arrayCategoria))
                return true;
            else
                return array(
                    'idErro'    => 8,
                    'message'   => 'Não foi possível inserir os dados no BD.'
                );
    
        } else
            return array(
                'idErro'    => 9,
                'message'   => 'Existem campos vazios.'
            );

    }

}

function excluirCategoria($id)
{}

function listarCategorias()
{}
