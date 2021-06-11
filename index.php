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
        <style>
            table, th, td {
                border: 1px solid black;
            }
            th{
                font-size: 22px
            }
        </style>
    </head>
    <body>
        <div style="text-align: center;">

            <a href="pages/cadastrar.html" style="font-size: 26px; text-decoration: none;">Cadastrar</a>
            <br>
            <br>
            <a href="pages/atualizar.php" style="font-size: 26px; text-decoration: none;">Editar</a>
            <br>
            <br>
            <a href="pages/deletar.php" style="font-size: 26px; text-decoration: none;">Excluir</a>
            <br>
            <br>
        </div>
        <h2>Lista de Produtos Cadastrados </h2>
        <br>
        <br>
        <br>
        <table style="width:50%; text-align: center;">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cor</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/dao/PrecoDAO.php");
                

                $produtos = PrecoDAO::read('true', '');

                foreach ($produtos as $produto) {
//                        if(count($produto->PRECO))
                    echo '<tr><td>' . $produto->NOME . '</td><td>' . $produto->COR . '</td><td>R$ ' . str_replace(".", ",", $produto->PRECO) . '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
