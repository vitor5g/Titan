<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <h3>Deletar Produto</h3>
            <form method="POST" id="formCadastroProduto" name="formDeletarProduto" action="../services/deleteProduto.php">
                <label>Escolha um produto</label>
                <select id="selectedProduto" name="selectedProduto" required="required">
                    <option value="">Selecione um produto</option>
                    <?php
                    //inclui arquivo
                    include_once ROOT_PATH . '/dao/ProdutoDAO.php';

                    $produtos = ProdutoDAO::read('', '');

                    foreach ($produtos as $produto) {
                        ?>
                        <option value="<?php echo $produto->getIDPROD() ?>"><?php echo $produto->getNOME() ?></option>
                    <?php } ?>
                </select>

                <input type="submit" id="btnSubmit" name="btnSubmit"/>
            </form>
        </div>
    </body>
</html>
