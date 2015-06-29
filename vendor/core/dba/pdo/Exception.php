<?php

namespace core\dba\pdo;

# Verifica as permissões de acesso a página
if (!defined('ACESSO')){
	die ("Acesso negado!.<br/>Entre em contato com o administrador do sistema.");
}

/**
 * Classe para tratamento de exceção no sistema, processa exceções e erros por grupo de acordo
 * com a característica do sistema.
 * Tipos de erros e exceção:
 * - erro na conexão ao banco de dados ( erro na conexão com o SGBD [usuario, senha, banco desconectado])
 * - erro na preparação de uma query ( bindParam: erro nos parâmetros passados a query )
 * - erro na execução de um query (select, insert, delete, update, alter, etc)
 * - erro na busca por um recurso (404 Not Found)
 * - erro na validação de entrada de dados (Utiliza a classe de validação para informar o erro)
 * - erro por tempo excedido no processamento da página
 * @author Elson Vinicius
 */
class Exception{
	
	/**
	 * Mensagem da exceção
	 * @var string
	 */
	private static $message;
	
	/**
	 * Código da exceção
	 * @var string
	 */
	private static $code;
	
	/**
	 * Arquivo em que ocorreu a exceção
	 * @var string
	 */
	private static $file;
	
	/**
	 * Linha em que ocorreu a exceção
	 * @var unknown_type
	 */
	private static $line;
	
	/**
	 * Rastro da exceção
	 * @var array
	 */
	private static $trace;
	
	/**
	 * Log da exceção
	 * @var unknown_type
	 */
	private static $log;
	
	
	public function __construct(){}
	
	/**
	 * Recupera a mensagem da exceção
	 */
	public static function getMessage(){
		return self::$message;
	}
	
	/**
	 * Altera a mensagem da exceção
	 * @param string $message
	 */
	public static function setMessage( $message ){
		self::$message = $message;
	}
	
	/**
	 * Recupera o código da exceção
	 */
	public static function getCode(){
		return self::$code;
	}
	
	/**
	 * Altera o código da exceção
	 * @param string $code
	 */
	public static function setCode( $code ){
		self::$code = $code;
	}
	
	/**
	 * Recupera o nome do arquivo que gerou a exceção
	 */
	public static function getFile(){
		return self::$file;
	}
	
	/**
	 * Altera o nome do arquivo que gerou a exceção
	 * @param string $file
	 */
	public static function setFile( $file ){
		self::$file = $file;
	}
	
	/**
	 * Recupera a linha em que ocorreu a exceção
	 */
	public static function getLine(){
		return self::$line;
	}
	
	/**
	 * Altera a linha que ocorreu a exceção
	 * @param string $line
	 */
	public static function setLine( $line ){
			self::$line = $line;
	}
	
	/**
	 * Recupera o array de dados da exceção 
	 */
	public static function getTrace(){
		return self::$trace;
	}
	
	/**
	 * Altera o array de dados da exceção
	 * @param array $trace
	 */
	public static function setTrace( Array $trace ){
		self::$trace = $trace;
	}
	
	
	/**
	 * Realiza a análise da função getTrace da classe PDO, permite
	 * identificar com detecho "Exceção gerada: getMessage() ".$message."<br/>";
			echo "Exceção gerada: getCode()".$code."<br/>";
			echo "<pre>";
			print_r($trace);
			echo "</pre>";
			die();alhes a mensagem de erro do sistema e gerar
	 * log para manutenção do erro
	 * @param array $trace
	 * @access private
	 */
	private static function debugTrace( Array $trace ){
		/*
		 * analisar a mensagem do getTrace e montar um esquema
		 * para gerar log e analise do erro no sistema.
		 */
		
		# --------------------------------------------------
		# IMPLEMENTAR TRATAMENTO DE EXCEÇÃO
		# --------------------------------------------------
	}
	
	/**
	 * Recebe os parâmetros da exceção, trata e seleciona
	 * a interface do usuário mais adequada para emitir
	 * a mensagem.
	 * @param string $message [Mensagem de exceção]
	 * @param string $code    [Código da exceção]
	 * @param array $trace    [Código gerado pela exceção]
	 */
	public static function debugException( $message, $code, $trace ){	
		self::setMessage( $message );
		self::setCode( $code );
		self::setTrace( $trace );
		
		# Erro com bloqueio de execução
		if( in_array($code, Array("0","1045","1049","2005"))){
			/*
			 * Erro na conexão com o banco de dados, nesse caso
			 * o sistema deverá interromper o script e apresentar
			 * uma página de erro informando ao usuário para entrar
			 * em contato com o administrador do sistema e com a 
			 * opção de tentar novamente o acesso. Deverá, obrigatoriamente,
			 * levar o usuário para a página de login do sistema.
			 */
			echo "O sistema se comportou de forma inesperada<br/>";
			echo "<br>Mensagem: ".$message." ($code)<br/>";
			echo "<br>Código: ".$code;
			echo "<pre>";
			print_r($trace);
			echo "</pre>";
			die();
			
		# erro com apresentação de mensagens ao usuário
		}else{
			/*
			 * Chamadas aos erros de inserção, deleção e alteração de dados,
			 * nesse caso o sistema não deve parar o processamento, mas sim
			 * informar ao usuário que a requisição não foi processada e 
			 * informar o que aconteceu, para fins de correção por parte
			 * do usuário. Nos casos de erros do sistema, bloquear a execução
			 * do script, apresentar uma página de erro e permitr ao usuário logar
			 * novamente no sistema.
			 */
			echo "<br/>O sistema se comportou de forma inesperada";
			echo "<br/>Mensagem: ".$message." ($code)";
			echo "<br>Código: ".$code;
			echo "<pre>";
			print_r($trace);
			echo "</pre>";
			die();
		}
	}# Fim de debugException
}# Fim da clase
?>