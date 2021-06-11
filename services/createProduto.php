<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/model/Produto.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/model/Preco.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/dao/ProdutoDAO.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/dao/PrecoDAO.php");
//include_once "../model/Produto.php";
//include_once "../model/Preco.php";
//include_once "../dao/ProdutoDAO.php";
//include_once "../dao/PrecoDAO.php";

try {
    $nome = ($_POST['nome']);
    $preco = trim(explode("R$", $_POST['preco'])[1]);
    if (strlen($preco) >= 8) {
        $preco = str_replace(",", ".", str_replace(".", "", $preco));
    }
    $cor = ($_POST['cor']);
    $produto = new Produto();


    //Desconto de 20%
    if ($cor == "AZUL" || $cor == "VERMELHO") {
        $porcentagem = 20;
        $preco = floatval($preco - ($preco * $porcentagem / 100));
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
    $produto->setNOME(trim($nome));
    $produto->setCOR(trim($cor));
    $produto->setPRECOPROD(trim($preco));


    $return = ProdutoDAO::create($produto);

    if ($return['success']) {
        $id = $return['id'];
        $dtoPreco = new Preco();
        $dtoPreco->setFKIDPROD($id);
        $dtoPreco->setPRECO($produto->getPRECOPROD());
        PrecoDAO::create($dtoPreco);
    }


    http_response_code(200);
    echo 'Produto criado com sucesso';
    echo '<br><br><a href="../index.php" style="font-size: 26px; text-decoration: none;">Home</a>';
} catch (Throwable $th) {
    http_response_code(500);
    echo $th->getMessage();
}


