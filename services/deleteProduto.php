<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/model/Produto.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/dao/ProdutoDAO.php");
//include_once ROOT_PATH . "/model/Produto.php";
//include_once ROOT_PATH . "/dao/ProdutoDAO.php";
try {

    $id = (int) ($_POST['selectedProduto']);

    $produto = new Produto();

    $produto->setIDPROD($id);

    ProdutoDAO::delete($produto);

    http_response_code(200);

    echo 'Produto removido com sucesso';
    echo '<br><br><a href="../index.php" style="font-size: 26px; text-decoration: none;">Home</a>';
} catch (Throwable $th) {
    http_response_code(500);
    echo $th->getMessage();
}


