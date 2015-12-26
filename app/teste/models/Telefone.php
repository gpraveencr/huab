<?php
namespace app\teste\models;

class Telefone
{
    /**
     * @pk
     * @column
     * @autoincrement
     */
    private $idTelefone         =   null;
    
    /**
     * @column
     */
    private $telefone           =   null;
    
    /**
     * @
     */
    private $idCliente          =   null;
    
    
    /**
     * @param array $id
     * Ex: array('idCliente'=>'1', 'id2'=>'valor2');
     */
    public function __construct( array $id = array() )
    {
        if(!empty($id))
            foreach ($id as $pk => $valor)
                $this->__set($pk, $valor);
    }# __construct
    
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