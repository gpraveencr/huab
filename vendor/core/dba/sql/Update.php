<?php

namespace core\dba\sql;

class Update{
    
    private $update = null;
    private $bindValue = array();
    
    /**
     * Método genérico para update em banco de dados. Recebe como parâmetro um array da valores
     * a serem modificados ($campo_valor) e um array de restrições para ($where) para evitar
     * alteração em todos os campos de uma tabela.
     * @param array $campo_valor [ array('id'=>1,'nome'=>Elson,'idade'=>34) ]
     * @param array $where [ array('id'=>1,'grupo'=>4) ]
     * @param string $table
     * @return number|NULL
     */
    public function add( array $campo_valor, array $where, $table ){
        
		$this->update = "update " . $table . " set ";
		
		foreach ( $campo_valor as $kCampoValor => $vCampoValor ) {
			# Colunas, atributos, do banco de dados
			$coluna[] = $kCampoValor . " = :".$kCampoValor;
			# Array de parâmetros e valores usados no bindParam(:parametro, valor)
			//$paramValor[] = array (":".$kCampoValor, $vCampoValor );
			$this->bindValue[$kCampoValor] = $vCampoValor;
		}
		$this->update .= implode ( ", ", $coluna );
		
		foreach ( $where as $kWhere => $vWhere ) {
			# Colunas, atributos, do banco de dados
			$parametro[] = $kWhere . " = :".$kWhere;
			# Array de parâmetros e valores usados no bindParam(:parametro, valor)
			//$paramValor[] = array (":".$kWhere, $vWhere );
			$this->bindValue[$kWhere] = $vWhere;
		}
		
		$this->update .= " where ";
		$this->update .= implode ( " and ", $parametro );
		
		//foreach ( $paramValor as $keyParam => $valueParam ) {
		    //$this->bindParam[$valueParam[0]] = $valueParam [1];
		//}
		return $this->update;
    }#add
    
    public function bindValue(){
        return $this->bindValue;
    }
    
    /**
     * Prepara a string SQL para execução no banco de dados
     * @return string $update
     */
    public function prepare(){
        return $this->update;
    }
    
}# update

?>