<?php

$form = (string) "router.php?component=categorias&action=inserir";

if (session_status())
    if (!empty($_SESSION['dadosCategoria'])) {

        $id = $_SESSION['dadosCategoria']['id'];
        $nome = $_SESSION['dadosCategoria']['nome'];

        $form = "router.php?component=categorias&action=editar&id=" . $id;

        unset($_SESSION['dadosCategoria']);
    }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="./css/categorias.css">
    <title>Dashboard</title>
</head>

<body>
    <main>
        <div class="container-banner">
            <div class="container-titulos">
                <h1>CMS - Projeto Games</h1>
                <h2>Gerenciamento do conteúdo do site</h2>
            </div>
            <div class="container-img-logo">
                <img src="./imgs/logozinho.png" alt="">
            </div>
        </div>
        <div class="container-banner-opcoes">
            <div class="container-sessoes">
                <div class="container-opcoes">
                    <div class="container-icon">
                        <a href="produto.php"><img src="./imgs/produto.png" alt=""></a>
                    </div>
                    <p>Adm. de Produtos</p>
                </div>
                <div class="container-opcoes">
                    <div class="container-icon">
                        <a href="#"><img src="./imgs/categoria.png" alt=""></a>
                    </div>
                    <p>Adm. de Categorias</p>
                </div>
                <div class="container-opcoes">
                    <div class="container-icon">
                        <a href="contato.php"><img src="./imgs/contato.png" alt=""></a>
                    </div>
                    <p>Contatos</p>
                </div>
                <div class="container-opcoes">
                    <div class="container-icon">
                        <a href="./usuario.php"><img src="./imgs/user.png" alt=""></a>
                    </div>
                    <p>Usuários</p>
                </div>
                <div class="container-opcoes">
                    <div class="container-icon">
                        <a href="./produto-categoria.php"><img src="./imgs/gerenciamento.png" alt=""></a>
                    </div>
                    <p>Produto-Categoria</p>
                </div>
            </div>
            <div class="container-infos">
                <p>Bem-vindo {nome}</p>
                <div class="container-opcoes">
                    <div class="container-icon">
                        <a href="#"><img src="./imgs/logout.png" alt=""></a>
                    </div>
                    <p>Logout</p>
                </div>
            </div>
        </div>

        <div class="container-sessao">
            <h3>Categorias</h3>

            <div class="container-categorias">
                <div class="container-form">
                    <form action="<?= $form ?>" method="post">
                        <div class="container-input">
                            <label>Nome:</label>
                            <input type="text" name="txtNome" value="<?= isset($nome) ? $nome : null ?>">
                        </div>
                        <input class="botaoSalvar" type="submit" value="Salvar">
                </div>
                </form>
                <div class="container-listagem">
                    <table class="tabela-categorias">
                        <th>Nome</th>
                        <th>Opções</th>

                        <?php

                        require_once('controller/controllerCategorias.php');
                        $listCategorias = listarCategorias();

                        foreach ($listCategorias as $item) {
                            
                        ?>
                            <tr>
                                <td class="td-nome"><?= $item['nome']; ?></td>
                                <td class="opcoes">
                                    <a onclick="return confirm('Deseja realmente excluir esse registro?');" href="router.php?component=categorias&action=deletar&id=<?= $item['id'] ?>">
                                        <img class="lixeira" src="./imgs/apagar.png" title="Deletar" alt="Deletar">
                                    </a>
                                    <a href="router.php?component=categorias&action=buscar&id=<?= $item['id'] ?>">
                                        <img src="./imgs/editar.svg" alt="Editar" title="Editar">
                                    </a>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>

                    </table>
                </div>
            </div>


        </div>
    </main>
    <footer>
        <span>Copyright 2022 © Todos os direitos reservados</span>
        <span>Desenvolvido por Leila Rosa. Versão 1.0.0</span>
    </footer>
</body>

</html>