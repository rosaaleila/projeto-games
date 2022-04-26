<?php

/**************************************************************************************
 * Objetivo: arquivo responsavel em realizar uploads de arquivos
 * Autora: Leila
 * Data: 26/04/2022
 * Versão: 1.0
 **************************************************************************************/

 function uploadFile($arrayFile)
 {

    require_once('modulo/config.php');

    $arquivo = $arrayFile;
    $sizeFile = (int) 0;
    $typeFile = (string) null;
    $nameFile = (string) null;
    $tempFile = (string) null;

    if($arquivo['size'] > 0 && $arquivo['type'] != "")
    {

        $sizeFile = $arquivo['size'] / 1024;

        $typeFile = $arquivo['type'];
        
        $nameFile = $arquivo['name'];
        
        $tempFile = $arquivo['tmp_name'];

        if($sizeFile <= MAX_FILE_UPLOAD)
        {
            if(in_array($typeFile, EXT_FILE_UPLOAD))
            {

                $nome = pathinfo($nameFile, PATHINFO_FILENAME);
                $extensao = pathinfo($nameFile, PATHINFO_EXTENSION);

                $nomeCrip = md5($nome.uniqid(time()));

                $foto = $nomeCrip . "." . $extensao;

                if(move_uploaded_file($tempFile, DIRETORIO_FILE_UPLOAD.$foto)) {
                    return $foto;
                } else {
                    return array();
                }

            } else {
                return array(
                    'idErro' => 12, 
                    'message' => 'A extensão do arquivo selecionado não é permitida no upload.'
            );
            }
        } else {
            return array(
                'idErro' => 10, 
                'message' => 'Tamanho de arquivo inválido no upload.'
            );
        }

    } else {
        return array(
            'idErro' => 11, 
            'message' => 'Não é possível realizar o upload sem um arquivo selecionado.'
        );
    }


 }



 ?>