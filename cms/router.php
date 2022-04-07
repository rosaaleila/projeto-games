<?php


/*************************************************************
 * Objetivo: arquivo de rota entre a view e a model
 * Autor: Leila Rosa
 * Data: 07/04/22
 * Versão: 1.0
 *************************************************************/

$action = (string) null;
$component = (string) null;

if ($_SERVER['REQUEST_METHOD'] ==  'GET') {

    $component = strtolower($_GET['component']);
    $action = strtolower($_GET['action']);

    // estrutura condicional para validar quem está solicitando e sua ação
    switch ($component) {

        case 'contatos';
            require_once('controller/controllerContatos.php');

            if($action == 'deletar') {

                $idContato = $_GET['id'];
                $result = deletarContato($idContato);

                if(is_bool($result)) {
                    if($result)
                        echo('<script> alert("Registro Deletado com Sucesso!"); window.location.href="dashboard.php"; </script>');
                } elseif (is_array($result))
                    echo('<script> alert("' . $result["message"] . '");  </script>');

            }

    }


}