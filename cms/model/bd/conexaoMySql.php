<?php

/*************************************************************
 * Objetivo: arquivo reponsável pela conexão com o MySQL
 * Autor: Leila Rosa
 * Data: 31/03/22
 * Versão: 1.0
 *************************************************************/

    const SERVER = 'localhost';
    const USER = 'root';
    const PASSWORD = 'bcd127';
    const DATABASE = 'teste';
    
    $resultado = abrirConexaoSql();

    function abrirConexaoSql()
    {
        $conexao =  mysqli_connect(SERVER, USER, PASSWORD, DATABASE);

        if($conexao)
            return $conexao;
        else
            return false;
    }

    function fecharConexaoSql($conexao) {
        mysqli_close($conexao);
    }