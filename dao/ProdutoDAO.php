<?php

//inclui arquivo
include_once '../connection/Conexao.php';
//inclui arquivo
include_once '../model/Produto.php';
//inclui arquivo
include_once '../model/Preco.php';
include_once 'PrecoDAO.php';

//cria classe ProdutoDAO
class ProdutoDAO {

    //cria função create que recebe um objeto do tipo Produto como parametro
    static function create(Produto $dto) {
        $return = false;
        //inicia try
        try {
            //cria variavel $db que recebe a conexão com o BD
            $db = Conexao::getConexao();
            //cria variavel $stmt que recebe o prepare de $db para preparar o sql para inserir
            $stmt = $db->prepare("INSERT INTO produto (NOME, COR) VALUES (?,?)");
            //seta o nome no primeiro parametro das ?
            $stmt->bindValue(1, $dto->getNOME(), PDO::PARAM_STR);
            //seta o sobrenome no segundo parametro das ?
            $stmt->bindValue(2, $dto->getCOR(), PDO::PARAM_STR);
            //executa o sql preparado
            $stmt->execute();
            //pega o id da inserção
            $id = $db->lastInsertId();

            $return = ['success' => true, 'id' => $id];

            //fim do try inicio do catch
        } catch (Throwable $th) {
            //caso dê erro ao inserir exibi a mensagem com o codigo do erro pego no catch
            $e = new Exception('Erro ao criar produto <br>' . $th->getMEssage());
            //lança a exceção pega na variavel é para ser tratada posteriormente
            throw $e;
        }

        return $return;
    }

    //cria função update que recebe um objeto do tipo Produto como parametro
    static function update(Produto $dto) {
        //inicia try
        try {
            //cria variavel $db que recebe a conexão com o BD
            $db = Conexao::getConexao();
            //cria variavel $stmt que recebe o prepare de $db para preparar o sql para atualizar
            $stmt = $db->prepare("UPDATE produto SET NOME=? WHERE IDPROD=?");
            //seta o nome no primeiro parametro das ?
            $stmt->bindValue(1, $dto->getNOME(), PDO::PARAM_STR);
            //seta o id no segundo parametro das ?
            $stmt->bindValue(2, $dto->getIDPROD(), PDO::PARAM_INT);

            //executa o sql preparado
            $stmt->execute();
            
            $preco = new Preco();
            $preco->setFKIDPROD($dto->getIDPROD());
            $preco->setPRECO($dto->getPRECOPROD());
            PrecoDAO::update($preco);

            //fim do try inico do catch
        } catch (Throwable $th) {
            //caso dê erro ao inserir exibi a mensagem com o codigo do erro pego no catch
            $e = new Exception('Erro ao atualizar produto <br>' . $th->getMEssage());
            //lança a exceção pega na variavel é para ser tratada posteriormente
            throw $e;
        }
    }

    //cria função delete que recebe um objeto do tipo Produto como parametro
    static function delete(Produto $dto) {
        //inicia try
        try {
            //cria um objeto do tipo venda com nome venda
            $preco = new Preco();
            //cria variavel $db que recebe a conexão com o BD
            $db = Conexao::getConexao();
            //cria variavel $stmt que recebe o prepare de $db para preparar o sql para deletar
            $stmt = $db->prepare("DELETE FROM produto WHERE IDPROD=?");
            //seta o id no primeiro parametro das ?
            $stmt->bindValue(1, $dto->getIDPROD(), PDO::PARAM_INT);

            //seta o id no objeto do tipo preco criado anteriormente
            $preco->setFKIDPROD($dto->getIDPROD());
            //chama a função de preco para deletar o preco referente aquele produto
            PrecoDAO::delete($preco);


            //executa o sql preparado
            $stmt->execute();
            //fim do try inico do catch
        } catch (Throwable $th) {
            //caso dê erro ao inserir exibi a mensagem com o codigo do erro pego no catch
            $e = new Exception('Erro ao remover produto <br>' . $th->getMEssage());
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
            $str = "SELECT * FROM produto ";
            //if que verifica se a variavel $filro é diferente de vazio
            if ($filtro != "") {
                //caso $filtro não seja diferente de vazio adiciona string a variavel $str
                $str = $str . " WHERE " . $filtro;
            }
            //if que verifica se a variavel $order é diferente de vazio
            if ($order != "") {
                //caso $order não seja diferente de vazio adiciona string a variavel $str
                $str = $str . " ORDER BY " . $order;
            }


            //executa o sql preparado
            $stmt = $db->query($str);

            //Define o modo de carga de dados para esta instrução como a classe Produto 
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Produto');
            //Retorna um array contendo todas as linhas do conjunto de resultados
            $dtos = $stmt->fetchAll();
            //retorna a variavel $dtos contendo os dados do SELECT            
            return $dtos;
            //fim do try inico do catch
        } catch (Throwable $th) {
            //caso dê erro ao inserir exibi a mensagem com o codigo do erro pego no catch
            $e = new Exception('Erro ao ler dados do produto <br>' . $th->getMEssage());
            //lança a exceção pega na variavel é para ser tratada posteriormente
            throw $e;
        }
    }

}
