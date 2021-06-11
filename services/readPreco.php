<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/model/Preco.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/Titan/dao/PrecoDAO.php");
//include_once "../model/Preco.php";
//include_once "../dao/PrecoDAO.php";


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