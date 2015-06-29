<?php

namespace core\dba\sql;

class Having{
    
    private $having = array();
    
    public function __construct(){}
    
    /**
     * A cláusula HAVING geralmente é utilizada com a cláusula GROUP BY para filtrar os resultados dos 
     * valores agregados. Entretanto, HAVING pode ser especificada sem GROUP BY. A cláusula HAVING 
     * especifica filtros adicionais aplicados após a cláusula WHERE ser filtrada. Esses filtros podem 
     * ser aplicados a uma função de agregação utilizada na lista de seleção.
     * @param string $columnGroupBy (deve ser uma coluna com função de agregação, definida no groupby)
     * @param string $operador 
     * @param string $valor
     * @param string $and_or
     * @return array $having
     */
    public function add( $columnGroupBy, $operador, $valor, $and_or = null ){
        $columnGroupBy = trim($columnGroupBy);
        $operador = trim($operador);
        $valor = trim($valor);
        $and_or = trim($and_or);
        
        if( !empty( $this->having ) ){
            if( !is_null( $and_or ) and ( in_array( strtoupper( $and_or ), array('AND','OR') ) ) ){
                $this->having[] =  " ".strtoupper( $and_or )." ".$columnGroupBy." ".$operador." ".$valor;
            }else{
                $this->having[] =  " AND ".$columnGroupBy." ".$operador." ".$valor;
            }
        }else{
            $this->having[] = " having ".$columnGroupBy." ".$operador." ".$valor;
        }
        return $this->having;
    }# add
    
    /**
     * Esse método foi criado para solucionar o problema
     * da variável where na classe Select.
     * @return Ambigous <multitype:, string>
     */
    public function getHaving(){
        return $this->having;
    }
}#having

?>