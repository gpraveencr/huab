<?php
namespace core\dba\sql;

class Where{
    
    private $where = array();
    private $bindValue = array();
    
    public function __construct(){}
    
    /**
     * Método para adicionar parâmetros a cláusula where
     * @param string $table
     * @param string $column
     * @param string $operador (AND, OR, IN, NOT IN, BETWEEN, NOT BETWEEN, LIKE e NOT LIKE)
     * @param string $valor
     * @param string $and_or
     */
    public function add( $column, $operador, $valor, $and_or = null ){
        $column = trim($column);
        $operador = trim($operador);
        $valor = trim($valor);
        $and_or = trim($and_or);
        
        if( !empty( $this->where ) ){
            if( !is_null( $and_or ) and ( in_array( strtoupper( $and_or ), array('AND','OR') ) ) ){
                $this->where[] =  " ".strtoupper( $and_or )." ".$column." ".$operador." :".$column;
            }else{
                $this->where[] =  " AND ".$column." ".$operador." :".$column;
            }
        }else{
            $this->where[] = " where ".$column." ".$operador." :".$column;
        }
        
        $this->bindValue[$column] = $valor;  
        
        return $this->where;
    }# add
    
    /**
     * Esse método foi criado para solucionar o problema
     * da variável where na classe Select.
     * @return Ambigous <multitype:, string>
     */
    public function getWhere(){
        return $this->where;
    }
    
    
    public function getBindValue(){
        return $this->bindValue;
    }
}# Where

?>