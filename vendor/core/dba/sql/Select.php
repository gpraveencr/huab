<?php

namespace core\dba\sql;

class Select{
    /**
     * tabelas para consulta
     * @var string
     */
    private $table = null;
    
    /**
     * colunas da consulta
     * @var string
     */
    private $column = null;
    
    /**
     * cláusula where
     * @var array
     */
    private $where = null;
    
    /**
     * cláusula having
     * @var array
     */
    private $having = null;
    
    private $groupBy = null;
    
    private $orderBy = null;
    
    private $limit = null;
    
    /**
     * parâmetro para validação de segurança das instruções SQL
     * @var array
     */
    private $bindValue = array();
    
    public function __construct(){}
    
    /**
     * Array de tabelas e colunas da consulta 
     * @param array $tableColumn
     * @example
     * <li>array( table => array(column1, column2))
     * <li>tabela['table'] = array(column1, column2)
     * <li>array( table => array(*) )
     */
    public function column( array $tableColumn ){
          
        foreach( $tableColumn as $table => $aColumn ){
            #$arrayTable[] = $table; (função desabilitada)
            $this->table = $table;
            foreach( $aColumn as $column ){
                $arrayColumn[] = $column;
            }
        }
        # lista de tabelas do campo from
        # $this->table = implode(', ', $arrayTable); (função desabilitada)
        
        # lista de colunas (campos)
        $this->column = implode(', ', $arrayColumn);
    }
    
    /**
     * 
     * 
     * operadores: AND, OR, IN, NOT IN, BETWEEN, NOT BETWEEN, LIKE e NOT LIKE     
     * @param string $column
     * @param string $operador (AND, OR, IN, NOT IN, BETWEEN, NOT BETWEEN, LIKE e NOT LIKE)
     * @param string $valor
     * @param string $and_or (and, or)
     * @return \core\pkg\dba\sql\array
     */
    public function where( $column, $operador, $valor, $and_or = null ){
        if( is_null( $this->where ) ){
            # se a variável estiver nula, o objeto é criado.
            # $where = new Where();
            $this->where = new Where();
        }
        #$this->where = $where->add( $column, $operador, $valor, $and_or );
        
        $this->where->add( $column, $operador, $valor, $and_or );
        $this->bindValue = $this->where->getBindValue();
        #$this->bindValue = $where->getBindValue();
        
        return $this->where;
    }
	
    /**
     * Vincula valor a um parâmetro
     * Armazena os valores por referência da cláusula Where, garante segurança nas operações
     * realizadas no banco de dados e evita SQL Injection.
     * @return array
     */
	public function bindValue(){
	    return $this->bindValue;
	}
	
	/**
	 * Especifica as colunas a serem usadas como chave para ordenar os registros retornados.
	 * valores aceitos:
	 * <li>ASC
	 * <li>DESC
	 * @param array $orderby
	 * @example array( array('idade','ASC'), array(altura, DESC) )
	 */
	public function orderBy( array $orderBy ){
	    foreach( $orderBy as $vOrderBy )
	        $this->orderBy[] = implode(" ", $vOrderBy );
	
	    $this->orderBy = " order by ".implode(", ", $this->orderBy);
	}
	
	/**
	 * Retorna o valor de cada grupo de registros. Cria um registro de resumo para cada registro definido.
	 * @param array $groupby
	 * @example array( coluna1, coluna2 )
	 */
	public function groupBy( array $groupBy ){
	    $this->groupBy = is_array( $groupBy ) ? " group by ".implode(", ", $groupBy ) : null;
	}
	
	/**
	 * A cláusula HAVING geralmente é utilizada com a cláusula GROUP BY para filtrar os resultados dos 
     * valores agregados. Entretanto, HAVING pode ser especificada sem GROUP BY. A cláusula HAVING 
     * especifica filtros adicionais aplicados após a cláusula WHERE ser filtrada. Esses filtros podem 
     * ser aplicados a uma função de agregação utilizada na lista de seleção.
	 * @param string $columnGroupBy
	 * @param string $operador
	 * @param string $valor
	 * @param string $and_or
	 * @return array $having
	 */
	public function having( $columnGroupBy, $operador, $valor, $and_or = null ){
	    if( empty( $this->having ) ){
	        $having = new Having();
	    }
	    $this->having = $having->add( $columnGroupBy, $operador, $valor, $and_or );
	    return $this->having;
	}
	
	/**
	 * Determina o limite de registros de uma consulta
	 * @param int $rowCount (número de linhas da consulta)
	 * @param int $startRow (linha inicial da consulta, se não for definida começa na linha 1)
	 */
	public function limit( $rowCount, $startRow = null ){
	    $this->limit = is_null( $startRow ) ? " limit ".$rowCount : " limit $startRow, $rowCount";
	}
	
	/**
	 * Subquery para a clausula where
	 * @param string $column
	 * @param string $operador - aceita também (IN, SOME, ANY)
	 * @param unknown $subQuery
	 * @param string $and_or - valores aceitos (AND/OR)
	 * @example $oSelect->subQuery("idCliente", "in", "select distinct idCliente from tab_LinguaFalada");
	 * @example $oSelect->subQuery("(idCliente, idade)", "in", "select idCliente, idade from tab_Cliente where idade < 30");
	 */
	public function subQuery( $column, $operador, $subQuery, $and_or = null){
	    $column = trim($column);
	    $operador = trim($operador);
	    $subQuery = trim($subQuery);
	    $and_or = trim($and_or);
	
	    if( !empty( $this->where ) ){
	        if( !is_null( $and_or ) and ( in_array( strtoupper( $and_or ), array('AND','OR') ) ) ){
	            $this->where[] =  " ".strtoupper( $and_or )." ".$column." ".$operador." (".$subQuery.")";
	        }else{
	            $this->where[] =  " AND ".$column." ".$operador." (".$subQuery.")";
	        }
	    }else{
	        $this->where[] = " where ".$column." ".$operador." (".$subQuery.")";
	    }
	     
	}#subQuery
	
	/**
	 * Monta o SQL para recuperar o total de linhas de uma consulta
	 * @return string
	 */
	public function rowCount(){
	    $select  = "select ";
	    $select .= " count(*) as total ";
	    $select .= $this->table;
	
	    if( !empty( $this->where ))
	        $select .= implode( ' ', $this->where );
	
	    if( !is_null( $this->groupBy ) AND !empty( $this->having ))
	        $select .= $this->having;
	
	    return $select;
	}
	
	/**
	 * Prepara a string SQL para execução no banco de dados
	 * @return string $select
	 */
	public function prepare(){
	    $select  = "select ";
	    
	    $select .= $this->column." from ".$this->table;
	    
	    if( !is_null( $this->where->getWhere() ) )
	        $select .= implode( ' ', $this->where->getWhere() );
	    
	    if( !is_null( $this->having ) )
	        $select .= implode( ' ', $this->having );
	    
	    if( !is_null( $this->orderBy ))
	        $select .= $this->orderBy;
	    	
	    if( !is_null( $this->groupBy ))
	        $select .= $this->groupBy;
	    	
	    if( !is_null( $this->groupBy ) AND !is_null( $this->having ))
	        $select .= implode( ' ', $this->having );
	    	
	    if( !is_null( $this->limit ))
	        $select .= $this->limit;
	    return $select;
	}#saida
    
}#Select

?>