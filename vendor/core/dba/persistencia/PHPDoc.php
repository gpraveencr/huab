<?php

namespace core\dba\persistencia;

class PHPDoc 
{
	
    #------------------------------------------
    # Propriedades de configuração da classe PHPDoc
    #------------------------------------------
	private $reflection;
	
	/**
	 * Recupera a documentação da classe, nesse campo deve
	 * ser registrada a tabela para mapeamento objeto relacional
	 * @var array
	 */
	private $docComment = array();
	
	/**
	 * armazena as propriedades visíveis de uma classe, devem obrigatoriamente possuir
	 * a tag @column true. Quando o valor for false a propriedade deverá ser ignorada.
	 * @var array
	 */
	private $properties = array();
	
	/**
	 * armazena os métodos disponíveis na classe passada como parâmetro 
	 * no construtor
	 * @var array
	 */
	private $methods = array();
	
	#------------------------------------------
	# Propriedades extraidas da classe passada
	# no parâmetro do construtor
	#------------------------------------------
	/**
	 * Armazena o namespace da classe
	 * @var strign
	 */
	private $namespace = null;
	
	/**
	 * Armazena a tabela da classe para mapeamento
	 * objeto relacional
	 * @var string
	 */
	private $table = null;
	
	/**
	 * Armazena a classe principal, ou seja o nome da classe passada
	 * no parâmetro do construtor.
	 * @var string
	 */
	private $className = null;
	
	/**
	 * Armazena todas as classes (principal + derivada)
	 * @var string
	 */
	private $classes = array();
	
	# armazena os atributos com a tag @class
	private $derivedClass = array();
	
	/**
	 * array de chaves primárias referenciados por uma classe.
	 * @var array
	 */
	private $pk = array();
	
	/**
	 * array de atributos persistentes de uma classe que, obrigatoriamente,
	 * devem estar referenciado em uma tabela.
	 * @var array
	 */
	private $column = array();
	
	/**
	 * array de chaves estrangeiras referenciadas por uma classe
	 * normalmente usada em relacionamento 1 x 1 ou N x 1
	 * @var array
	 */
	private $fk = array();
	
	/**
	 * armazena a chave primária quando a PK for do 
	 * tipo auto_increment
	 * só pode haver 1 (uma) chave primária desse tipo
	 * por tabela.
	 * @var string
	 */
	private $autoincrement = null;
	
	
	/**
	 * Construtor da classe PHPDoc, requer como parâmetro o nome
	 * da classe a ser analisada, esse parâmetro deve vir de um
	 * objeto ativo e o nome da classe recuperado pelo método
	 * get_class( $objeto ). Ex: new PHPDoc( get_class( $objeto ) )
	 * @param string $_class
	 */
	public function __construct( $_class ) {
		# reflexão dos metadados da classe
		$this->reflection = new \ReflectionClass( $_class );
		
		# armazena o nome da classe principal
		$this->className = $_class;
		
		# recupera as propriedades da classe
		$this->setDocComment();
		
		$this->namespace = $this->reflection->getNamespaceName();
		
		# recupera as propriedades da classe principal
		$this->setProperties ();
	}
	
	# ---------------------------------------------
	# DOCUMENTAÇÃO GERAL DA CLASSE
	# ---------------------------------------------
	/**
	 * Recupera a documentação da classe
	 */
	 public function setDocComment(){
	     
    	 # recupera o comentário da classe
    	 $docComment = $this->reflection->getDocComment();
    	 # retira a primeira linha do comentário
    	 $docComment = str_replace( "/**", "", $docComment );
    	 # retira a última linha do comentário
    	 $docComment = str_replace( "*/", "", $docComment );
    	 
    	 # gera um array com as demais linhas constantes no comentário
    	 /*
    	 * Ex:
    	 * *@column (linha 1)
    	 * *@class (linha 2)
    	 */
    	 $docComment = explode( '*', $docComment );
    	
    	 # cria um array com a classe ArrayObject
    	 # O array $doc armazena todas as tags de um atributo, cada atributo
    	 # pode ter uma ou mais tags.
    	 $docComment = new \ArrayObject( $docComment );
    	
    	 # retira o primeiro elemento do array (elemento vazio)
    	 $docComment->offsetUnset( 0 );
    	  
    	 foreach( $docComment as $comment ){
    	   # recupera a lista de classes derivadas
    	   if ( strstr ( $comment, "@table" )) {
    	       $var = explode ( "@table", $comment );
    	       $this->table = trim ( $var[1] );
    	   }
    	   
    	   # --------------------------------------------
    	   # INSERIR AQUI NOVOS ATRIBUTOS
    	   # --------------------------------------------
    	   
    	 }#foreach
	 }#setDocComment
	
	/**
	 * Esse método analisa a classe passada no parâmetro do construtor
	 * e recupera todos os atributos da classe, analisa a documentação
	 * do atributo e monta um conjunto de variáveis com base nessa documentação.
	 * As seguitnes tags são aceitas:
	 * <li>@pk - indica que o atributo refere-se a uma chave primária na tabela
	 * 
	 * <li>@column - indica que o atributo é uma coluna válida na tabela que 
	 * referencia a classe principal. Usar apenas nos atributos 
	 * 
	 * <li>@referencedClass - indica que esse atributo da classe principal faz 
	 * referência a uma outra classe que é fonte dos dados. Normalmente é uma atributo
	 * de múltiplos valores do tipo array. Atende ao relacionamento 1 x 1, 1 x N e N x N.
	 * Essa tag indica que a chave primária da tabela que representa a classe principal 
	 * está referenciada em outra tabela representada pela classe referenciada
	 * 
	 * <li>@fk
	 * @param string $_class
	 */
	private function setProperties() {
		# armazena a classe principal
		
		// $class->getProperties(): recupera lista de atributos da classe
		foreach ( $this->reflection->getProperties() as $attributes ) {
			
			# recupera os comentários dos atributos
			$doc = $attributes->getDocComment();
			# retira a primeira linha do comentário
			$doc = str_replace( "/**", "", $doc );
			# retira a última linha do comentário
			$doc = str_replace( "*/", "", $doc );
			# gera um array com as demais linhas constantes no comentário
			/*
			 * Ex: 
			 * *@column (linha 1)
			 * *@class (linha 2)
			 */
			$doc = explode( '*', $doc );
			
			# cria um array com a classe ArrayObject
			# O array $doc armazena todas as tags de um atributo, cada atributo
			# pode ter uma ou mais tags.
			$doc = new \ArrayObject( $doc );
			
			# retira o primeiro elemento do array (elemento vazio)
			$doc->offsetUnset( 0 );
			
			# percorre o array de tags do atributo e define cada variável de documentação.
			foreach ( $doc as $comment ) {
			    
				# array de identificadores únicos da classe (primary key)
				if (strstr ( $comment, "@pk" )) {
				    $this->pk[] = $attributes->getName ();
				    $this->properties [$this->className][] = $attributes->getName ();
				}
				
				# array de atributos persistentes da classe
				if (strstr ( $comment, "@column" )) {
					$this->column[] = $attributes->getName ();
					$this->properties [$this->className][] = $attributes->getName ();
				}
				
				# recupera a lista de classes derivadas (atributo e valor)
				if ( strstr ( $comment, "@class" )) {
				    $var = explode ( "@class", $comment );
				    $this->derivedClass[$attributes->getName ()] = trim ( $var[1] );
				    $this->properties [ trim ( $var[1] )] = $attributes->getName ();
				}
				# ---------------------------------------------
				# INSERIR NOVAS REGRAS AQUI
				# ---------------------------------------------
				# recupera a lista de classes derivadas (atributo e valor)
				if (strstr ( $comment, "@autoincrement" )) {
				    $this->autoincrement = $attributes->getName ();
				    $this->properties [$this->className][] = $attributes->getName ();
				}
			}
		} // fim do foreach
		$this->properties;
	}# setProperties
	
	
	# ---------------------------------------------
	# FUNÇÕES PARA MANIPULAÇÃO INTERNA DAS CLASSES
	# ---------------------------------------------
	/**
	 * recupera um array de propriedades da classe
	 * @return \app\novapersistencia\array
	 */
	public function getProperties() {
		return $this->properties;
	}
	
	/**
	 * Verifica se o método existe na classe
	 * @param string $method
	 * @return boolean
	 */
	public function hasMethod( $method ){
		return $this->reflection->hasMethod( $method );
	}# fim: hasMethod
	
	/**
	 * Recupera informações do método do parâmetro
	 * @param string $method
	 * @return array
	 */
	public function getMethod( $method ){
		if( $this->hasMethod( $method ) ){
			return $this->reflection->getMethod( $method );
		}else{
			return array();
		}
	}
	
	/**
	 * Recupera todos os métodos da classe
	 * @return multitype:
	 */
	public function getMethods(){
		return $this->reflection->getMethods();
	}
	
	
	# INCLUIR AQUI OS NOVOS METODOS PARA RECUPERAR INFORMAÇÕES
	
	
	public function getNamespace(){
	    return $this->namespace;
	}
	
	/**
	 * Recupera o nome da classe principal
	 * @return string
	 */
	public function getClassName(){
		return $this->className;
	}
	
	public function getTable(){
	    return $this->table;
	}

    /**
     * Recupera o array de chaves primárias
     * 
     * @return array - formato: array(pk1, pk2, pk3)
     */
    public function getPK()
    {
        return $this->pk;
    }
	
	/**
	 * Recupera o array de chaves estrangeiras
	 * @return array
	 */
	public function getColumn() 
	{
	    return $this->column;
	}
	
	/**
	 * Recupera as classes derivadas
	 * @return array
	 */
	public function getDerivedClass()
	{
		return $this->derivedClass;
	}
	
	/**
	 * Recupera o array de chaves estrangeiras
	 * @return string
	 */
	public function getFK() 
	{
	    return $this->fk;
	}
	
	/**
	 * Recupera a chave primária do tipo
	 * auto_increment
	 * @return string pk auto_increment
	 */
	public function getAutoincrement()
	{
	    return $this->autoincrement;
	}
	
}# fim da classe phpDoc
?>