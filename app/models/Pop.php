<?php

namespace app\models;

class Pop
{
    /**
     * @pk
     * @column
     */
    private $idPop;
    
    /**
     * @column
     */
    private $tarefa;
    
    /**
     * @column
     */
    private $atividades;
    
    private $sql;
    
    /**
     * 
     * @param Conexao $oCon
     * @param array $param
     */
    public function __construct( $persitencia = null, $identificador = array() ){
        
        if( !is_null( $persitencia ))
            $this->pObj = $persitencia;
        
        if( !empty( $identificador ) ){
            foreach ($identificador as $atributo => $valor ){
                $this->__set( $atributo, $valor );
            }
            $persitencia->getObject( $this );
        }
    }#__construct
    
    public function getObject()
    {
        $this->pObj->getObject( $this );
    }
    
    public function getAll( $where = array() )
    {
        return $this->pObj->getAllArray( $this , $where );
    }
    
    /**
     * Metodo mágico GET, usado para recuperar
     * os atributos do objeto
     * @param string $atributo
     */
    public function __get( $atributo )
    {
        return $this->$atributo;
    }# __get
    
    /**
     * Método mágico SET, usado genericamente
     * para alterar os atributos do objeto
     * @param string $atributo
     * @param mixed $valor
     */
    public function __set( $atributo, $valor )
    {
        $this->$atributo = $valor;
    }# __set
}

?>