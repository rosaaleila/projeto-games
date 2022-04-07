<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/contatos.css">
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
                <img src="../imgs/logozinho.png" alt="">
            </div>
        </div>
        <div class="container-banner-opcoes">
            <div class="container-sessoes">
                <div class="container-opcoes">
                    <div class="container-icon">
                        <a href="#"><img src="../imgs/produto.png" alt=""></a>
                    </div>
                    <p>Adm. de Produtos</p>
                </div>
                <div class="container-opcoes">
                    <div class="container-icon">
                        <a href="./categoria.php"><img src="../imgs/categoria.png" alt=""></a>
                    </div>
                    <p>Adm. de Categorias</p>
                </div>
                <div class="container-opcoes">
                    <div class="container-icon">
                        <a href="#"><img src="../imgs/contato.png" alt=""></a>
                    </div>
                    <p>Contatos</p>
                </div>
                <div class="container-opcoes">
                    <div class="container-icon">
                        <a href="#"><img src="../imgs/user.png" alt=""></a>
                    </div>
                    <p>Usuários</p>
                </div>
            </div>
            <div class="container-infos">
                <p>Bem-vindo {nome}</p>
                <div class="container-opcoes">
                    <div class="container-icon">
                        <a href="#"><img src="../imgs/logout.png" alt=""></a>
                    </div>
                    <p>Logout</p>
                </div>
            </div>
        </div>

        <div class="container-sessao">
            <h3>Mensagens</h3>
                <div class="container-tabela">

                    <table class="tabela-contatos">
                    <th class="th-esquerda">Nome</th>
                    <th class="th-meio">E-mail</th>
                    <th class="th-direita">Mensagem</th>
                    <th class="lixeira"></th>

                        <?php

                        require_once('../controller/controllerContatos.php');
                        $listContato = listarContatos();

                        foreach ($listContato as $item) {
                        ?>
                            <tr>
                                <td class="td-esquerda"><?= $item['nome'] ?></td>
                                <td class="td-meio"><?= $item['email'] ?></td>
                                <td class="td-direita"><?= $item['mensagem'] ?></td>
                                <td class="lixeira"><a href="router.php?component=contatos&action=deletar&id=<?= $item['id'] ?>"><img class="img-deletar" title="Deletar" src="../imgs/apagar.png" alt=""></a></td>
                            </tr>
                            
                        <?php
                        }
                        ?>

                    </table>

                </div>
        </div>
    </main>
    <footer>
        <span>Copyright 2022 © Todos os direitos reservados</span>
        <span>Desenvolvido por Leila Rosa. Versão 1.0.0</span>
    </footer>
</body>

</html>