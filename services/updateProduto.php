<?php

include_once ROOT_PATH . "/model/Produto.php";
include_once ROOT_PATH . "/model/Preco.php";
include_once ROOT_PATH . "/dao/ProdutoDAO.php";
include_once ROOT_PATH . "/dao/PrecoDAO.php";

try {
    $nome = ($_POST['nome']);
    $preco = trim(str_replace("R$", " ", $_POST['preco']));
    $id = (int) $_POST['selectedProduto'];

    $produto = new Produto();

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


