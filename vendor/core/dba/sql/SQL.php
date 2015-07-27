<?php

namespace core\dba\sql;

class SQL{

    /**
     * Armazena o objeto de conexão ao SGDB
     * @var object
     */
    private $con;

    /**
     * Armazena a conexão ao SGBD
     * @access protected
     * @var mixed
     */
    private $link;

    /**
     * Armazena o resultado das consultas ao SGBD
     * @access protected
     * @var mixed
     */
    private $result;

    /**
     * Armazena o número de linhas afetadas nas operações
     * realizadas nos banco de dados, funciona para select,
     * insert, delete, update.
     * @access protected
     * @var integer
     */
    private $rows;
    
    # NOVOS ATRIBUTOS

    private $select = null;
    
    private $insert = null;

    private $delete = null;
    
    private $update = null;

    private $function = null;

    /**
     * Construtor da classe, recupera o conexão com o SGBD
     * @access public
     * @param Conexao $oCon
     */
    public function __construct( $oCon ){
        # interface para o objeto de conexão 
        $this->con = $oCon;
        
        # Recupera a conexão com o SGBD
        $this->link = $oCon->getLink();
    }# __construct
    
    /**
	 * Define o tipo de resultado em uma operação realizada no banco de dados
	 * @access protected
	 * @var array
	 * - PDO::FETCH_ASSOC: returns an array indexed by column name as returned in your result set
	 * - PDO::FETCH_BOTH (default): returns an array indexed by both column name and 0-indexed column number as returned in your result set
	 * - PDO::FETCH_BOUND: returns TRUE and assigns the values of the columns in your result set to the PHP variables to which they were bound 
	 * with the PDOStatement::bindColumn() method
	 * - PDO::FETCH_CLASS: returns a new instance of the requested class, mapping the columns of the result set to named properties in the class.
	 * If fetch_style includes PDO::FETCH_CLASSTYPE (e.g. PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE) then the name of the class is determined from 
	 * a value of the first column.
	 * - PDO::FETCH_INTO: updates an existing instance of the requested class, mapping the columns of the result set to named properties in the class
	 * - PDO::FETCH_LAZY: combines PDO::FETCH_BOTH and PDO::FETCH_OBJ, creating the object variable names as they are accessed
	 * - PDO::FETCH_NUM: returns an array indexed by column number as returned in your result set, starting at column 0
	 * - PDO::FETCH_OBJ: returns an anonymous object with property names that correspond to the column names returned in your result set
	 */
    protected function fetchMode( $FETCH ){

        switch ( $FETCH ){
            case 'FETCH_ASSOC':
                $this->result->setFetchMode ( \PDO::FETCH_ASSOC );
                break;

            case 'FETCH_BOTH':
                $this->result->setFetchMode ( \PDO::FETCH_BOTH );
                break;

            case 'FETCH_BOUND':
                $this->result->setFetchMode ( \PDO::FETCH_BOUND );
                break;

            case 'FETCH_CLASS':
                $this->result->setFetchMode ( \PDO::FETCH_CLASS );
                break;

            case 'FETCH_INTO':
                $this->result->setFetchMode ( \PDO::FETCH_INTO );
                break;

            case 'FETCH_LAZY':
                $this->result->setFetchMode ( \PDO::FETCH_LAZY );
                break;

            case 'FETCH_NUM':
                $this->result->setFetchMode ( \PDO::FETCH_NUM );
                break;

            case 'FETCH_OBJ':
                $this->result->setFetchMode ( \PDO::FETCH_OBJ );
                break;
        }# switch

    }#fetchMode
    
    /**
     * <documentar>
     * @return Ambigous <\pkg\dba\sql\Select, string>
     */
    public function select(){
        # 
        if( is_null( $this->select ) ){
            $this->select = new \core\dba\sql\Select();
        }
        
        # armazena o método/função a ser executado no método execute()
        $this->function = __FUNCTION__;
        
        # retorna uma string para consulta de dados
        return $this->select;
    }# select

    public function delete(){
        
        if( is_null( $this->delete ) ){
            $this->delete = new \core\dba\sql\Delete();
        }
        
        # armazena o método/função a ser executado no método execute()
        $this->function = __FUNCTION__;
        
        # retorna uma string SQL para exclusão de dados
        return $this->delete;
        
    }
    
    
    public function update(){
              
        if( is_null( $this->update ) ){
            $this->update = new \core\dba\sql\Update();
        }
        
        # armazena o método/função a ser executado no método execute()
        $this->function = __FUNCTION__;
        
        # retorna uma string SQL para alterar dados
        return $this->update;
        
    }
    
    public function insert(){
        
        if( is_null( $this->insert ) ){
            $this->insert = new \core\dba\sql\Insert();
        }
        
        # armazena o método/função a ser executado no método execute()
        $this->function = __FUNCTION__;
        
        # retorna uma string SQL para inclusão de dados 
        return $this->insert;
    }


    /**
     * função para executar as instruções SQL no banco de dados
     * @return boolean
     */
    public function execute(){
        
        $this->result = $this->link->prepare( $this->{$this->function}()->prepare() );
        
        switch ( $this->function ){
            case 'select':
                # Verificar a consistência dos parâmetros (segurança)
                if( !empty( $this->{$this->function}()->bindValue() ) )
                    foreach( $this->{$this->function}()->bindValue() as $kBindValue => $vBindValue )
                        $this->result->bindValue( ":".$kBindValue, $vBindValue );# public bool PDOStatement::bindValue ( mixed $parameter , mixed $value [, int $data_type = PDO::PARAM_STR ] )
                
                $this->{$this->function} = null;
                
                try{

                    # Executar a consulta no banco de dados
                    $this->result->execute();
                         
                    # Indexar o resultado da pesquisa pelo nome do campo e/ou pelo índice
                    $this->fetchMode( "FETCH_ASSOC" );

                    # recuperar o número de registros da consulta
                    $this->rows = $this->result->rowCount();

#----                    
# debug(__FILE__, __LINE__, $this->result->rowCount(),"NÚMERO DE LINHAS:");

                    # Recuperar a consulta como um array de dados
                    return $this->result->fetchAll();

                }catch ( \PDOException $e ){
                    # Controla a exceção na execução de uma query no banco de dados
                    \core\dba\pdo\Exception::debugException( $e->getMessage(), $e->getCode(), $e->getTrace() );
                    return false;
                }
                break;

            case 'update':
                
                if( !empty( $this->{$this->function}()->bindValue() ) )
                    foreach( $this->{$this->function}()->bindValue() as $kBindValue => $vBindValue )
                        $this->result->bindValue( ":".$kBindValue, $vBindValue );
                    
                    
                $this->{$this->function} = null;
                
                try {
                    # Executa a instrução SQL
                    $this->result->execute ();
                     
                    # Recupera o número de linhas afetadas pela instrução
                    $this->rows = $this->result->rowCount();
                     
                    return $this->rows;
                     
                } catch ( \PDOException $e ) {
                    // Controla a exceção na execução de uma query no banco de dados
                    \core\dba\pdo\Exception::debugException ( $e->getMessage (), $e->getCode (), $e->getTrace () );
                    return null;
                }
                break;

            case 'insert':
                
                if( !empty( $this->{$this->function}()->bindValue() ) )
                    foreach( $this->{$this->function}()->bindValue() as $kBindValue => $vBindValue )
                        $this->result->bindValue( ":".$kBindValue, $vBindValue );
                
                $this->{$this->function} = null;
                    
                try{
                    	
                    # Executar a inserção no banco de dados
                    $this->result->execute();
                    	
                    # recuperar o número de registros da consulta
                    $this->rows = $this->result->rowCount();
                    	
                    return $this->rows;
                    	
                }catch ( \PDOException $e ){
                    # Controla a exceção na execução de uma query no banco de dados
                    \core\dba\pdo\Exception::debugException( $e->getMessage(), $e->getCode(), $e->getTrace() );
                    return false;
                }
                break;

            case 'delete':
                
                if( !empty( $this->{$this->function}()->bindValue() ) )
                    foreach( $this->{$this->function}()->bindValue() as $kBindValue => $vBindValue )
                        $this->result->bindValue( ":".$kBindValue, $vBindValue );

                $this->{$this->function} = null;
                
                try{
                    # Executa a instrução SQL
                    $this->result->execute();
                    	
                    # Recupera o número de linhas afetadas pela instrução
                    $this->rows = $this->result->rowCount();
                    	
                    return $this->rows;
                    	
                }catch ( \PDOException $e ){
                    # Controla a exceção na execução de uma query no banco de dados
                    \core\dba\pdo\Exception::debugException( $e->getMessage(), $e->getCode(), $e->getTrace() );
                    	
                    return null;
                }
                break;

            default:

                break;
        }#switch
    }#execute
    
   /**
    * Recupera o número de linhas afetadas nas operações
    * de select, insert, delete e update;
    * @return number
    */
    public function getNumberRows(){
        return $this->rows;
    }
    
    /**
     * Recupera o id do último campo
     * inserido no banco de dados
     * @return number
     */
    public function lastInsertId(){
        return $this->con->lastInsertId();
    }

}# SQL
?>