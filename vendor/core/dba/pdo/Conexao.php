<?php 
namespace core\dba\pdo;

/**
 * Projeto: Framework
 * Data de criação do script: 2011
 * Data da última alteração: 22 Ago 14
 * Autor: Elson Vinicius
 * Descrição: Esse script tem por objetivo estabelecer, manter e encerrar uma conexão
 * ao banco de dados. Permite que sejam realizadas conexões aos seguintes SGBD: MySQL,
 * Oracle, DB2, PostGre, Firebird.
 */

/**
 * A classe Conexao estabelece e mantém a conexão com o SGBD.
 * @author Elson Vinicius
 * @version 1.0.0
 */
class Conexao{
	# -------------------------------------------------
	# ATRIBUTOS DA CONEXÃO
	/**
	 * string de conexão ao SGBD, composta pelo driver, host,dbname e port
	 * formato: driver:host=""; dbname="";
	 * @access private
	 * @var string
	 */
	private $dsn;
	
	/**
	 * Driver de conexão ao SGBD
	 * @access private
	 * @var string
	 */
	private $driver;
	
	/**
	 * Nome de domínio ou IP do servidor do SGBD
	 * @access private
	 * @var string
	 */
	private $host;
	
	/**
	 * Nome do banco de dados da conexão
	 * @access private
	 * @var string
	 */
	private $dbname;
	
	/**
	 * Porta de conexão ao SGBD
	 * @access private
	 * @var string
	 */
	private $port;
	
	/**
	 * Usuário do banco de dados
	 * @access private
	 * @var string
	 */
	private $username;
	
	/**
	 * Senha do usuário do banco de dados
	 * @access private
	 * @var string
	 */
	private $passwd;
	
	/**
	 * Opções para conexão ao banco de dados
	 * @access private
	 * @var array
	 */
	private $options = array();
	
	/**
	 * Armazena a conexão ao banco de dados
	 * @access private
	 * @var mixed
	 */
	private $link;
	
	# -------------------------------------------------
	/**
	 * O construtor da classe carrega as variáveis de conexão ao SGBD
	 * @param string $driver [<br/>-SQL Server/Sybase/FreeTDS: dblib;<br/>-Firebird/Interbase 6: firebird;<br/>-IBM DB2: ibm;<br/>-IBM Informix: informix;
	 * <br/>-MySQL: mysql;<br/>-Oracle: oci;<br/>-PostgreSQL: pgsql;<br/>-SQLite 3/SQLite: sqlite;<br/>-MySQL Server/SQL Azure: sqlsrv ]
	 * @param string $host [nome ou ip do servidor do SGBD]
	 * @param string $port [porta de conexão ao SGBD]
	 * @param string $dbname [nome da base de dados da conexão]
	 * @param string $username [usuário do banco de dados]
	 * @param string $passwd [senha do usuário do banco de dados]
	 * @param array $options [opções para conexão, depende do tipo de driver]
	 */
	public function __construct( $driver, $host, $dbname, $username, $passwd, $port = null, $options = array() ){
		$this->driver = $driver;
		$this->host = $host;
		$this->dbname = $dbname;
		$this->username = $username;
		$this->passwd = $passwd;
		$this->port = $port;
		$this->options = $options;
	}
	
	/**
	 * O método getLink estabelece ou recupera uma conexão com o banco de dados, se não for passado nenhum parâmetro no contrutor o sistema buscará as variáveis
	 * globais do arquivo de configuração do banco de dados (configDataBase.php)
	 * <p> A passagem de parâmetros ocorre quando houver necessidade de alterar o banco de dados
	 * da classe persistente.
	 * @access public
	 * @return mixed [conexão ao banco de dados]
	 */
	public function getLink(){
		# garante apenas uma instância da classe \PDO.
		if( !is_object( $this->link )){
			if( is_null( $this->port ) ){
				# Bloco executado se a porta de conexão for padrão
				$this->dsn = $this->driver.":host=".$this->host.";dbname=".$this->dbname;
			}else{
				# Bloco acessado se a porta de conexão for definida pelo usuário
				$this->dsn = $this->driver.":host=".$this->host.";port=".$this->port.";dbname=".$this->dbname;
			}
			
			try{
				# Cria uma conexão com o banco de dados
				$this->link =  new \PDO( $this->dsn, $this->username, $this->passwd, $this->options );
			}catch ( \PDOException $e ){
				/*
				 * Se ocorrer excessão, os dados são passados para a classe de controle
				 * de excessão do framework. Essa classe gerencia os dados que são passados
				 * na interface do usuário e fornece as opções para solução do problema.
				 */
				\core\dba\pdo\Exception::debugException( $e->getMessage(), $e->getCode(), $e->getTrace() );
			}
			$this->link->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		return $this->link;
	}# fim do método getLink
	
	/**
	 * Recupera o driver da conexão com o banco de dados
	 * @access public
	 * @return $driver
	 */
	public function getDriver(){
		return $this->driver;
	}
	
	/**
	 * Recupera o host[IP] da conexão com o banco de dados
	 * @access public
	 * @return $driver
	 */
	public function getHost(){
		return $this->host;
	}
	
	/**
	 * Recupera o banco de dados da conexão com o banco de dados
	 * @access public
	 * @return $driver
	 */
	public function getDBName(){
		return $this->dbname;
	}
	
	/**
	 * Recupera a porta da conexão com o banco de dados
	 * @access public
	 * @return $driver
	 */
	public function getPort(){
		return $this->port;
	}
	
	/**
	 * Recupera o status da conexão ativa
	 * @access public
	 * @return string
	 */
	public function getStatusConenction(){
		return $this->link->getAttribute( \PDO::ATTR_CONNECTION_STATUS );
	}
	
	/**
	 * Recupera o versão do cliente da aplciação
	 * @access public
	 * @return string
	 */
	public function getVersionClient(){
		return $this->link->getAttribute( \PDO::ATTR_CLIENT_VERSION );
	}
	
	/**
	 * Recupera o nome do drive da conexão
	 * @access public
	 * @return string
	 */
	public function getDriverName(){
		return $this->link->getAttribute( \PDO::ATTR_DRIVER_NAME );
	}
	
	/**
	 * Recupera informação do servidor da conexão 
	 * @access protected
	 * @return string
	 */
	public function getServerInfo(){
		return $this->link->getAttribute( \PDO::ATTR_SERVER_INFO );
	}
	
	/**
	 * Fecha a conexão com o banco de dados
	 * @access protected
	 */
	protected function closeConnection(){
		unset( $this->link );
	}
	
	/**
	 * Inicia uma transação no SGBD
	 */
	public function beginTransaction(){
		$this->link->beginTransaction();
	}
	
	/**
	 * Confirma uma transação realizada pelo SGBD
	 */
	public function commit(){
		$this->link->commit();
	}
	
	/**
	 * Desfaz todas as alterações realizadas numa
	 * transação do SGBD
	 */
	public function rollBack(){
		$this->link->rollBack();
	}
	
	/**
	 * Recupera o id da último insert realizado
	 * no banco de dados, domente para campos 
	 * do tipo auto-incremento
	 * @return String
	 */
	public function lastInsertId(){
		return $this->link->lastInsertId();
	}
}# Fim da classe Conexao

/*
 * # Instância padrão da classe para as conexões ao banco de dados
        global $oCon;
        $oCon = new \core\dba\pdo\Conexao( DRIVER, HOST, DBNAME, USERNAME, PASSWD );
 */
?>