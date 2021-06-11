<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/model/Produto.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/model/Preco.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/dao/ProdutoDAO.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/dao/PrecoDAO.php");
//include_once ROOT_PATH . "/model/Produto.php";
//include_once ROOT_PATH . "/model/Preco.php";
//include_once ROOT_PATH . "/dao/ProdutoDAO.php";
//include_once ROOT_PATH . "/dao/PrecoDAO.php";

try {
    $nome = ($_POST['nome']);
    $preco = trim(explode("R$", $_POST['preco'])[1]);
    if (strlen($preco) >= 8) {
        $preco = str_replace(",", ".", str_replace(".", "", $preco));
    }
    $id = (int) $_POST['selectedProduto'];
    $cor = ($_POST['hiddenCor']);


    $produto = new Produto();


    //Desconto de 20%
    if ($cor == "AZUL" || $cor == "VERMELHO") {
        $porcentagem = 20;
        $preco = $preco - ($preco * $porcentagem / 100);
//        $preco = number_format($preco, 2, ",", ".");
        //Desconto de 10%
    } elseif ($cor == "AMARELO") {
        $porcentagem = 10;
        $preco = $preco - ($preco * $porcentagem / 100);
        //Desconto de 50%
    } elseif ($cor == "VERMELHO" && $preco > 50.00) {
        $porcentagem = 50;
        $preco = $preco - ($preco * $porcentagem / 100);
    }

    $produto->setIDPROD($id);
    $produto->setNOME(trim($nome));
    $produto->setPRECOPROD(trim($preco));

    $return = ProdutoDAO::update($produto);


    http_response_code(200);
    echo 'Produto atualizado com sucesso';
    echo '<br><br><a href="../index.php" style="font-size: 26px; text-decoration: none;">Home</a>';
} catch (Throwable $th) {
    http_response_code(500);
    echo $th->getMessage();
}


