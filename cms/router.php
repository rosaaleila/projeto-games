<?php

/*************************************************************
 * Objetivo: arquivo de rota entre a view e a model
 * Autor: Leila Rosa
 * Data: 07/04/22
 * Versão: 1.4
 *************************************************************/

$action = (string) null;
$component = (string) null;

if ($_SERVER['REQUEST_METHOD'] ==  'GET' || $_SERVER['REQUEST_METHOD'] ==  'POST') {

    $component = strtolower($_GET['component']);
    $action = strtolower($_GET['action']);

    // estrutura condicional para validar quem está solicitando e sua ação
    switch ($component) {

        case 'contatos';
            require_once('controller/controllerContatos.php');

            if ($action == 'deletar') {

                $idContato = $_GET['id'];
                $result = deletarContato($idContato);

                if (is_bool($result)) {
                    if ($result)
                        echo ('<script> alert("Registro Deletado com Sucesso!"); window.location.href="contato.php"; </script>');
                } elseif (is_array($result))
                    echo ('<script> alert("' . $result["message"] . '");  </script>');
            }

        case 'categorias';

            require_once('controller/controllerCategorias.php');

            if ($action == 'inserir') {

                $result = adicionarCategoria($_POST);

                if (is_bool($result))
                    if ($result)
                        echo ('<script> alert("Registro Inserido com Sucesso!"); window.location.href="categoria.php"; </script>');
                    elseif (is_array($result))
                        echo ('<script> alert("' . $result["message"] . '"); window.history.back();  </script>');
            } elseif ($action == 'deletar') {

                $idCategoria = $_GET['id'];
                $result = excluirCategoria($idCategoria);

                if (is_bool($result)) {
                    if ($result)
                        echo ('<script> alert("Registro Deletado com Sucesso!"); window.location.href="categoria.php"; </script>');
                } elseif (is_array($result))
                        echo ('<script> alert("' . $result["message"] . '"); window.history.back(); </script>');
            } elseif ($action == 'buscar') {

                $idCategoria = $_GET['id'];

                $dados = buscarCategoria($idCategoria);

                session_start();

                $_SESSION['dadosCategoria'] = $dados;

                require_once('categoria.php');

            }
    }
}
