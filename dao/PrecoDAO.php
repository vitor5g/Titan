<?php

//inclui arquivo
include_once ROOT_PATH . '../connection/Conexao.php';
//inclui arquivo
include_once ROOT_PATH . '../model/Preco.php';

//cria classe PrecoDAO
class PrecoDAO {

    //cria função create que recebe um objeto do tipo Preco como parametro
    static function create(Preco $dto) {
        //inicia try
        try {
            //cria variavel $db que recebe a conexão com o BD
            $db = Conexao::getConexao();
            //cria variavel $stmt que recebe o prepare de $db para preparar o sql para inserir
            $stmt = $db->prepare("INSERT INTO preco (PRECO, FKIDPROD) VALUES (?,?)");
            //seta o sabor no primeiro parametro das ?
            $stmt->bindValue(1, $dto->getPRECO(), PDO::PARAM_STR);
            //seta a quantidade no segundo parametro das ?
            $stmt->bindValue(2, $dto->getFKIDPROD(), PDO::PARAM_INT);

            //executa o sql preparado
            $stmt->execute();
            //pega o id da inserção
            $id = $db->lastInsertId();
            //fim do try inicio do catch
        } catch (Throwable $th) {
            //caso dê erro ao inserir exibi a mensagem com o codigo do erro pego no catch
            $e = new Exception('Erro ao criar preco <br>' . $th->getMEssage());
            //lança a exceção pega na variavel é para ser tratada posteriormente
            throw $e;
        }
    }

    //cria função update que recebe um objeto do tipo Preco como parametro
    static function update(Preco $dto) {
        //inicia try
        try {
            //cria variavel $db que recebe a conexão com o BD
            $db = Conexao::getConexao();
            //cria variavel $stmt que recebe o prepare de $db para preparar o sql para atualizar
            $stmt = $db->prepare("UPDATE preco SET PRECO=? WHERE FKIDPROD=?");
            //seta o sabor no primeiro parametro das ?
            $stmt->bindValue(1, $dto->getPRECO(), PDO::PARAM_STR);
            //seta a quantidade no segundo parametro das ?
            $stmt->bindValue(2, $dto->getFKIDPROD(), PDO::PARAM_INT);

            //executa o sql preparado
            $stmt->execute();
            //fim do try inicio do catch
        } catch (Throwable $th) {
            //caso dê erro ao inserir exibi a mensagem com o codigo do erro pego no catch
            $e = new Exception('Erro ao atualizar preco <br>' . $th->getMEssage());
            //lança a exceção pega na variavel é para ser tratada posteriormente
            throw $e;
        }
    }

    //cria função delete que recebe um objeto do tipo Preco como parametro
    static function delete(Preco $dto) {
        //inicia try
        try {

            //cria variavel $db que recebe a conexão com o BD
            $db = Conexao::getConexao();
            //cria variavel $stmt que recebe o prepare de $db para preparar o sql para deletar
            $stmt = $db->prepare("DELETE FROM preco WHERE FKIDPROD=?");
            //seta o id no primeiro parametro das ?
            $stmt->bindValue(1, $dto->getFKIDPROD(), PDO::PARAM_INT);

            //executa o sql preparado
            $stmt->execute();
            //fim do try inicio do catch
        } catch (Throwable $th) {
            //caso dê erro ao inserir exibi a mensagem com o codigo do erro pego no catch
            $e = new Exception('Erro ao remover preco <br>' . $th->getMEssage());
            //lança a exceção pega na variavel é para ser tratada posteriormente
            throw $e;
        }
    }

    //cria função read que recebe 2 variaveis um $filto ou uma $order para clausula WHERE e ORDER BY do SQL respectivamente
    static function read($filtro, $order) {
        //inicia try
        try {
            //cria variavel $db que recebe a conexão com o BD
            $db = Conexao::getConexao();
            //cria uma variavel $str que recebe o SQL para realizar o SELECT no BD
            $str = "SELECT *, produto.NOME, produto.COR FROM preco";
            //if que verifica se a variavel $filro é diferente de vazio
            if ($filtro != "") {
                //caso $filtro não seja diferente de vazio adiciona string a variavel $str
                $str = $str . " INNER JOIN produto ON preco.FKIDPROD = produto.IDPROD WHERE " . $filtro;
            }
            //if que verifica se a variavel $order é diferente de vazio
            if ($order != "") {
                //caso $order não seja diferente de vazio adiciona string a variavel $str
                $str = $str . " ORDER BY " . $order;
            }


            //executa o sql preparado
            $stmt = $db->query($str);

            //Define o modo de carga de dados para esta instrução como a classe Preco 
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Preco');

            //Retorna um array contendo todas as linhas do conjunto de resultados
            $dtos = $stmt->fetchAll();

            //retorna a variavel $dtos contendo os dados do SELECT            
            return $dtos;
            //fim do try inico do catch
        } catch (Throwable $th) {
            //caso dê erro ao inserir exibi a mensagem com o codigo do erro pego no catch
            $e = new Exception('Erro ao ler dados do preco <br>' . $th->getMEssage());
            //lança a exceção pega na variavel é para ser tratada posteriormente
            throw $e;
        }
    }

}
