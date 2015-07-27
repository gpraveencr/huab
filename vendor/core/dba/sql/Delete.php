<?php

namespace core\dba\sql;

class Delete{
    
    private $delete = null;
    private $bindValue = array();
    
    /**
     * Método generico para exclusão de dados. Para evitar a deleção de todos os registros da tabela
     * o método delete exige restrição na cláusula where.
     * @param array $where [ array('id'=>1,'group'=>'alfa') ]
     * @param string $table
     * @return string
     */
    public function add( array $where, $table ){

        $this->delete = "delete from ".$table." where ";
		
		foreach( $where as $kWhere => $vWhere ){
			# Colunas, atributos, do banco de dados
			$coluna_parametro[] = $kWhere." = :".$kWhere;
			# Array de parâmetros e valores usados no bindParam(:parametro, valor)
			//$paramValor[] = array(":".$kWhere, $vWhere);
			$this->bindValue[$kWhere] = $vWhere;
		}
		
		$this->delete .= implode(" and ", $coluna_parametro);
		
		return $this->delete;
    }# add
    
    public function bindValue(){
        return $this->bindValue;
    }
    
    public function prepare(){
        return $this->delete;
    }
    
}# Delete

?>