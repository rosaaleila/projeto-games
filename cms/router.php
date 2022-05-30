<?php

/*************************************************************
 * Objetivo: arquivo de rota entre a view e a model
 * Autor: Leila Rosa
 * Data: 07/04/22
 * Versão: 1.5
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
            break;
        case 'categorias';

            require_once('controller/controllerCategorias.php');

            if ($action == 'inserir') {

                $result = adicionarCategoria($_POST);

                if (is_bool($result)) {
                    if ($result)
                        echo ('<script> alert("Registro Inserido com Sucesso!"); window.location.href="categoria.php"; </script>');
                } elseif (is_array($result))
                    echo ('<script> alert("' . $result["message"] . '"); window.location.href="categoria.php";  </script>');
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
            } elseif ($action == 'editar') {

                $idCategoria = $_GET['id'];

                $result = atualizarCategoria($_POST, $idCategoria);

                if (is_bool($result)) {
                    if ($result)
                        echo ('<script> alert("Registro Atualizado com Sucesso!"); window.location.href="categoria.php"; </script>');
                } elseif (is_array($result))
                    echo ('<script> alert("' . $result["message"] . '"); window.history.back(); </script>');
            }
            break;
        case 'usuarios';

            require_once('controller/controllerUsuarios.php');

            if ($action == 'inserir') {

                $result = adicionarUsuario($_POST);

                if (is_bool($result)) {
                    if ($result)
                        echo ('<script> alert("Registro Inserido com Sucesso!"); window.location.href="usuario.php"; </script>');
                } elseif (is_array($result))
                    echo ('<script> alert("' . $result["message"] . '"); window.history.back();  </script>');
            } elseif ($action == 'deletar') {

                $idUsuario = $_GET['id'];

                $result = excluirUsuario($idUsuario);

                if (is_bool($result)) {
                    if ($result)
                        echo ('<script> alert("Registro Deletado com Sucesso!"); window.location.href="usuario.php"; </script>');
                } else if (is_array($result))
                    echo ('<script> alert("' . $result["message"] . '"); window.history.back(); </script>');
            } elseif ($action == 'buscar') {

                $idUsuario = $_GET['id'];

                $dados = buscarUsuario($idUsuario);

                session_start();

                $_SESSION['dadosUsuario'] = $dados;

                require_once('usuario.php');
            } elseif ($action == 'editar') {

                $idUsuario = $_GET['id'];

                $result = atualizarUsuario($_POST, $idUsuario);

                if (is_bool($result)) {
                    if ($result)
                        echo ('<script> alert("Registro Atualizado com Sucesso!"); window.location.href="usuario.php"; </script>');
                } elseif (is_array($result))
                    echo ('<script> alert("' . $result["message"] . '"); window.history.back(); </script>');
            }

            break;
        case 'produtos';

            require_once('controller/controllerProdutos.php');

            if ($action == 'inserir') {

                if(isset($_FILES) && !empty($_FILES))
                    $result = inserirProduto($_POST, $_FILES);
                else
                    $result = inserirProduto($_POST, null);

                if (is_bool($result)) {
                    if ($result)
                        echo ('<script> alert("Registro Inserido com Sucesso!"); window.location.href="produto.php"; </script>');
                } elseif (is_array($result))
                    echo ('<script> alert("' . $result["message"] . '"); window.history.back();  </script>');

            } elseif ($action == 'deletar') {

                $idProduto = $_GET['id'];
                $foto = $_GET['foto'];

                $dadosProduto = array(
                    "id"    => $idProduto,
                    "foto"  => $foto
                );

                $result = excluirProduto($dadosProduto);

                if(is_bool($result)) {
                    if($result)
                        echo ('<script> alert("Registro Deletado com Sucesso!"); window.location.href="produto.php"; </script>');
                } elseif (is_array($result))
                    echo ('<script> alert("' . $result["message"] . '"); window.back.history(); </script>');

            } elseif ($action == 'buscar') {

                $idProduto = $_GET['id'];

                $dados = buscarProduto($idProduto);

                session_start();

                $_SESSION['dadosProduto'] = $dados;

                require_once('produto.php');

            } elseif ($action == 'editar') {

                $idProduto = $_GET['id'];
                $foto = $_GET['foto'];

                $arrayDados = array(
                    "id"    => $idProduto,
                    "foto"  => $foto,
                    "file"  => $_FILES
                );

                $result = atualizarProduto($_POST, $arrayDados);

                if(is_bool($result)) {
                    if($result)
                        echo ('<script> alert("Registro Atualizado com Sucesso!"); window.location.href="produto.php"; </script>');
                } elseif(is_array($result))
                    echo ('<script> alert("' . $result["message"] . '"); window.history.back(); </script>');

            }

            break;
        case 'gerenciamento':

            require_once('./controller/controllerGerenciamento.php');

            if ($action == 'inserir') {

                $result = adicionarProdutoCategoria($_POST);

                if (is_bool($result)) {
                    if ($result)
                        echo ('<script> alert("Registro Inserido com Sucesso!"); window.history.back(); </script>');
                } elseif (is_array($result))
                    echo ('<script> alert("' . $result["message"] . '"); window.history.back();  </script>');

            } elseif ($action == 'deletar') {
                $id = $_GET['id'];

                $result = excluirProdutoCategoria($id);

                if (is_bool($result)) {
                    if ($result)
                        echo ('<script> alert("Registro Deletado com Sucesso!"); window.history.back(); </script>');
                } else if (is_array($result))
                    echo ('<script> alert("' . $result["message"] . '"); window.history.back(); </script>');
            } elseif ($action == 'buscar') {
                $id = $_GET['id'];

                $dados = buscarProdutoCategoria($id);

                session_start();

                $_SESSION['dados'] = $dados;

                require_once('produto-categoria.php');
            } elseif ($action == 'editar') {
                $id = $_GET['id'];

                $result = atualizarProdutoCategoria($_POST, $id);

                if (is_bool($result)) {
                    if ($result)
                        echo ('<script> alert("Registro Atualizado com Sucesso!"); window.history.back(); </script>');
                } elseif (is_array($result))
                    echo ('<script> alert("' . $result["message"] . '"); window.history.back(); </script>');
            }

            break;
    }
}
