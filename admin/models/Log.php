<?php


class Log
{
    private $idLog;
    private $registro;
    private $datetime;
    
    public function __construct( $file, $line, $value )
    {
        
    }
    
    private function getLog()
    {
        
    }
    
    private function setLog( array $log ){
        
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