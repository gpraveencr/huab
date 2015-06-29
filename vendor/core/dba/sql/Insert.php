<?php

namespace core\dba\sql;

class Insert{
    
    private $insert = null;
    private $bindValue = array();
    
    
    /**
     * Método para montagem do comando SQL;
     * @param array $columnValue [array("column1"=>valor,"column2"=>"valor")]
     * @param string $table
     */
    public function add( array $columnValue, $table ){
        $this->insert  = "insert into ".$table."( ";
        # le os valores do array campo_valor
        foreach( $columnValue as $kColumn => $value ){
            # Colunas, atributos, do banco de dados
            $coluna[] = $kColumn;
            # Monta o conjunto de parâmetros do select Ex: :idUser
            $parametro[] = ":".$kColumn;
            # carrega os parâmetros
            $this->bindValue[$kColumn] = $value; 
        }
        $this->insert .= implode(", ", $coluna)." ) ";
        $this->insert .= "values( ";
        $this->insert .= implode( ", ", $parametro );
        $this->insert .= " )";
        
        return $this->insert;
    }
    
    public function bindValue(){
        return $this->bindValue;
    }
    
    /**
     * Prepara a string SQL para execução no banco de dados
     * @return string $insert
     */
    public function prepare(){
        return $this->insert;
    }
    
}







?>