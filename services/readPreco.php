<?php

include_once ROOT_PATH . "/model/Preco.php";
include_once ROOT_PATH . "/dao/PrecoDAO.php";


try {
    $data = json_decode($_POST['data']);

    $FKIDPROD = (int) $data->FKIDPROD;

    $dtos = PrecoDAO::read('FKIDPROD = ' . $FKIDPROD, '');

    if (isset($dtos)) {
        echo json_encode($dtos);
    } else {
        echo json_encode(Array());
    }
} catch (\Throwable $th) {
    http_response_code(500);
    echo $th->getMessage();
}