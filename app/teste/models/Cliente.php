<?php
namespace app\teste\models;

class Cliente
{
    /**
     * @pk
     * @column
     * @autoincrement
     */
    private $idCliente          =   null;
    
    /**
     * @column
     */
    private $nome               =   null;
    
    /**
     * @column
     */
    private $dataNascimento     =   null;
    
    /**
     * @column
     * @referencedColumn idSituacao
     */
    private $situacao           =   null;
    
    /**
     * @class Telefone
     */
    private $telefone           =   array();
    
    /**
     * @class LinguaFalada
     */
    private $linguaFalada       =   array();
    
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
    
}# class Cliente


class ClientePersist extends \core\dba\sql\SQL
{
    private $object;

    public function __construct($oCon, $object)
    {
        parent::__construct($oCon);
        
        #a classe é passada como referência
        $this->object = &$object;
        
        # função desabilitada, pois interfere no update
        //if( !is_null( $this->object->__get("idPop") ) ){}
            //$this->getObject();
    }
    
    
    /**
     * Regra de negócio: esse método deve retornar apenas 1 registro
     * como resultado do banco de dados. Se retornar mais de 1 registro
     * a consulta é inválida (fatal_eror). Se não retornar registro na
     * consulta, a interface deve ser notificada.
     */
    
    /**
     * Recupera a instância de 1 objeto no banco de dados. Permite apenas
     * 1 resultado de busca.
     */
    public function getObject()
    {
        # obter a documentação da classe
        $doc = new \core\dba\persistencia\PHPDoc(get_class($this->object));
    
        # definir a tabela e os campos da consulta SQL
        $this->select()->column(array("tab_Pop" => $doc->getColumn()));
    
        # definir a restrição da consulta com base na chave primária (definir código para chaves múltiplas - relacionamento MxN)
        $this->select()->where("idPop", "=", $this->object->__get("idPop"));
    
        $this->setAttributes($this->execute());
    
        //return $this->getNumberRows();
    
    }# getObject
    
    
}# class ClientePersist

?>