<?php

require_once('modulo/config.php');

$form = (string) "router.php?component=produtos&action=inserir";
$foto = (string) null;

if (session_status())
    if(!empty($_SESSION['dadosProduto'])) {

        $id = $_SESSION['dadosProduto']['id'];
        $nome = $_SESSION['dadosProduto']['nome'];
        $descricao = $_SESSION['dadosProduto']['descricao'];
        $preco = $_SESSION['dadosProduto']['preco'];
        $promocao = $_SESSION['dadosProduto']['promocao'];
        $foto = $_SESSION['dadosProduto']['foto'];
        
        if ($_SESSION['dadosProduto']['destaque'] == 1) 
            $statusDestaque = "checked";
        else
            $statusDestaque = null;

        $form = "router.php?component=produtos&action=editar&id=" . $id . "&foto=" . $foto;

        unset($_SESSION['$dadosProduto']);
    
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="./css/produtos.css">
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
                        <a href="categoria.php"><img src="./imgs/categoria.png" alt=""></a>
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
        <div class="container-form-infos">
                <form action="<?= $form ?>" method="post" enctype="multipart/form-data">
                    <div class="container-input">
                        <p>Nome:</p>
                        <input type="text" name="txtNome" value="<?= isset($nome) ? $nome : null ?>">
                    </div>
                    <div class="container-input">
                        <p>Descrição:</p>
                        <input type="text" name="txtDescricao" value="<?= isset($descricao) ? $descricao : null ?>">
                    </div>
                    <div class="container-input">
                        <p>Preço:</p>
                        <input type="number" name="txtPreco" value="<?= isset($preco) ? $preco : null ?>">
                    </div>
                    <div class="container-input">
                        <p>Promoção:</p>
                        <input type="number" name="txtPromocao" value="<?= isset($promocao) ? $promocao : null ?>">
                    </div>
                    <div class="container-input">
                        <p>Produto em Destaque:</p>
                        <input type="checkbox" name="chkDestaque" <?= isset($statusDestaque) ? $statusDestaque : null ?>>
                    </div>
                    <div class="container-input-file">
                        <div class="container-input-fle">
                            <p>Escolha um arquivo:</p>
                            <input type="file" class="input-arquivo" name="fleFoto" accept=".jpg, .jpeg, .png, .gif, .webp">
                        </div>
                        <div class="container-img-produto">
                            <img src="<?= DIRETORIO_FILE_UPLOAD.$foto ?>" alt="">
                        </div>
                    </div>
                    
                    <input type="submit" value="Enviar" class="btnEnviar">
                </form>
            </div>
            <div class="container-produtos">
                <table class="tabela-produtos">
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Promoção</th>
                    <th>Destaque</th>
                    <th>Imagem</th>
                    <th>Opções</th>

                    <?php

                    require_once('controller/controllerProdutos.php');
                    $listProdutos = listarProdutos();

                    foreach ($listProdutos as $item)
                    {
                        $foto = $item['foto'];
                        $destaque = $item['destaque'];
                        $destaqueStatus = (string) "Não";

                        if($destaque == 1) {
                            $destaqueStatus = "Sim";
                        }

                    ?>  

                        <tr>
                            <td class="td-nome"><?= $item['nome'] ?></td>
                            <td class="td-descricao"><?= $item['descricao'] ?></td>
                            <td class="td-preco">R$<?= $item['preco'] ?></td>
                            <td class="td-promocao"><?= $item['promocao'] ?>%</td>
                            <td class="td-promocao"><?= $destaqueStatus ?></td>
                            <td class="td-imagem"><img src="<?= DIRETORIO_FILE_UPLOAD.$foto ?>" alt=""></td>
                            <td class="td-opcoes">
                                <a href="router.php?component=produtos&action=buscar&id=<?= $item['id'] ?>"><img src="./imgs/editar.svg" alt="Editar"></a>
                                <a onclick="return confirm('Deseja realmente excluir esse registro?');" href="router.php?component=produtos&action=deletar&id=<?= $item['id'] ?>&foto=<?= $foto ?>"><img src="./imgs/apagar.png" alt="Apagar"></a>
                            </td>
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