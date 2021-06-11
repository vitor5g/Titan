-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.6-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para titan
CREATE DATABASE IF NOT EXISTS `titan` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `titan`;

-- Copiando estrutura para tabela titan.preco
CREATE TABLE IF NOT EXISTS `preco` (
  `IDPRECO` int(11) NOT NULL AUTO_INCREMENT,
  `PRECO` decimal(10,2) DEFAULT NULL,
  `FKIDPROD` int(11) NOT NULL,
  PRIMARY KEY (`IDPRECO`),
  KEY `fk_id_prod` (`FKIDPROD`),
  CONSTRAINT `fk_id_prod` FOREIGN KEY (`FKIDPROD`) REFERENCES `produto` (`IDPROD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela titan.produto
CREATE TABLE IF NOT EXISTS `produto` (
  `IDPROD` int(11) NOT NULL AUTO_INCREMENT,
  `NOME` varchar(50) DEFAULT NULL,
  `COR` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IDPROD`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Exportação de dados foi desmarcado.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
