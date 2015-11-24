<?php

namespace admin\models;

/*
 * o objetivo dessa classe é gerenciar a tabelas do banco de dados
 * 
 * - deve permitir visualização dos metadados da tabela
 * - deve permitir edição dos comentários de cada campo da tabela
 */

class Tabelas extends \core\dba\sql\SQL
{
    
    public function __construct($oCon)
    {
        parent::__construct($oCon);
    }
    
    
    /**
     * Método para recuperar a lista de tabelas do base de dados da conexão
     * @return \core\dba\sql\boolean
     */
    public function getTables( $driver )
    {
        switch ( $driver ){
            
            case "mysql":
                $this->select()->column(array("tables" => array("TABLE_NAME","ENGINE","TABLE_ROWS","TABLE_COMMENT")));
                //$this->select()->column(array("tables" => array("*")));
                $this->select()->where( "TABLE_SCHEMA", "=", "huab" );
                return $this->execute();
                break;
                
            case "firebird":
                
                break;
                
        }
    }# getTables
    
    private function mysql()
    {
        $dicionario_dados = "information_schema";
    }
    
}# Tabelas

?>