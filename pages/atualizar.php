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

        <script src="../public/js/jquery-3.3.1.js"></script>
        <script src="../public/js/jquery.maskMoney.js"></script>
        <script src="../public/js/jquery.maskMoney.min.js"></script>

        <script>

            $().ready(function () {
                $("#preco").maskMoney({
                    allowNegative: true,
                    thousands: '.',
                    decimal: ',',
                    prefix: 'R$ '
                });

            });

            function getProduto(value) {
                let obj = {};
                obj.FKIDPROD = value;

                $.ajax({
                    type: "POST",
                    url: "../services/readPreco.php",
                    dataType: "html",
                    async: true,
                    timeout: 30000,
                    data: {data: JSON.stringify(obj)},
                    success: function (response) {
                        //vai rodar aqui se der certo
                        let dados = JSON.parse(response);
                        let preco = String(dados[0].PRECO).replace(".", ",")
                        document.getElementById('preco').value = preco;
                        document.getElementById('nome').value = dados[0].NOME;
                        document.getElementById('cor').value = dados[0].COR;
                        document.getElementById('cor').disabled = true;
                        document.getElementById('hiddenCor').value = dados[0].COR;
                    },
                    error: function (error) {
                        //roda aqui se der errado
                    },
                    complete: function () {
                    }
                });

            }
        </script>

    </head>

    <body>
        <div>
            <h3>Atualização de Produto</h3>
            <form method="POST" id="formCadastroProduto" name="formAtualizarProduto" action="../services/updateProduto.php">
                <label>Escolha um produto</label>
                <select id="selectedProduto" name="selectedProduto" onchange="getProduto(this.options[this.selectedIndex].value);" required="required">
                    <option value="">Selecione um produto</option>
                    <?php
                    //inclui arquivo
//                    include_once '../dao/ProdutoDAO.php';
                     include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/dao/ProdutoDAO.php");

                    $produtos = ProdutoDAO::read('', '');

                    foreach ($produtos as $produto) {
                        ?>
                        <option value="<?php echo $produto->getIDPROD() ?>"><?php echo $produto->getNOME() ?></option>
                    <?php } ?>
                </select>
                <br>
                <br>
                <label>Nome</label>
                <input type="text" maxlength="50" id="nome" name="nome" required="required"/>
                <br>
                <br>
                <label>Preço</label>
                <input type="text" id="preco" name="preco" required="required"/>
                <br>
                <br>
                <label>Cor</label>
                <select id="cor" name="cor" required="required">
                    <option value="AZUL">AZUL</option>
                    <option value="VERMELHO">VERMELHO</option>
                    <option value="AMARELO">AMARELO</option>
                </select>
                <input type="hidden" id="hiddenCor" name="hiddenCor" />
                <br>
                <br>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Salvar"/>
            </form>
        </div>
    </body>
</html>
