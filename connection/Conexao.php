<?php


class Conexao{
    private static $host = "localhost";
    private static $user = "root";
    private static $password = "";
    private static $database = "titan";
    private static $charset = "utf8";
    private static $conexao;


    public static function getConexao(){
        try {
            if(Conexao::$conexao==null){
               //abre e retorna a Conexao 

               Conexao::$conexao = new PDO(
               "mysql:host=".Conexao::$host.
               ";dbname=".Conexao::$database.
               ";unix_socket=/cloudsql/projeto-titan:southamerica-east1:mysqltitan".
               ";charset=".Conexao::$charset,
               Conexao::$user,Conexao::$password
            );

               return Conexao::$conexao;
            }else{
                return Conexao::$conexao;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


}





?>