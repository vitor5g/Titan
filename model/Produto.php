<?php

class Produto {

    public $IDPROD;
    public $NOME;
    public $COR;
    public $PRECOPROD;

    function __construct(){

    }
    
    function getIDPROD() {
        return $this->IDPROD;
    }

    function getNOME() {
        return $this->NOME;
    }

    function getCOR() {
        return $this->COR;
    }

    function setIDPROD($IDPROD) {
        $this->IDPROD = $IDPROD;
    }

    function setNOME($NOME) {
        $this->NOME = $NOME;
    }

    function setCOR($COR) {
        $this->COR = $COR;
    }
    
    function getPRECOPROD() {
        return $this->PRECOPROD;
    }

    function setPRECOPROD($PRECOPROD) {
        $this->PRECOPROD = $PRECOPROD;
    }







}