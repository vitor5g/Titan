<?php

class Preco {

    public $IDPRECO;
    public $PRECO;
    public $FKIDPROD;

    function __construct(){

    }
    
    function getIDPRECO() {
        return $this->IDPRECO;
    }

    function getPRECO() {
        return $this->PRECO;
    }

    function setIDPRECO($IDPRECO) {
        $this->IDPRECO = $IDPRECO;
    }

    function setPRECO($PRECO) {
        $this->PRECO = $PRECO;
    }
    
    function getFKIDPROD() {
        return $this->FKIDPROD;
    }

    function setFKIDPROD($FKIDPROD) {
        $this->FKIDPROD = $FKIDPROD;
    }




    
   


}