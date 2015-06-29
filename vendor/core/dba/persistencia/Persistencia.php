<?php

namespace core\dba\persistencia;

use \core\dba\sql\SQL;

class Persistencia extends SQL
{
    private $object;
    private $doc;
    private $table;
    
    public function __construct( $oCon )
    {
        parent::__construct($oCon);
    }
    
    /**
     * Novo modelo genérico para recuperação de dados
     * @param string $table
     * @param array $column
     * @param array $identificador ex: array(array( 'campo' => 'valor' );
     */
    public function getObject( $object )
    {
        $this->object = &$object;
        $doc = new \core\dba\persistencia\PHPDoc( get_class($object) );
        $this->setTable( get_class($object) );
        
        
        $this->select()->column( array( $this->table => $doc->getColumn() ) );
        
        foreach ( $doc->getPK() as $pk ){
            if( !is_null( $this->object->__get( $pk ) ) ){
                $this->select()->where( $pk, "=", $this->object->__get( $pk ) );
            }
                
        }
        $this->setAttributes( $this->execute() );
    }# getObject
    
    # recupera uma lista de objetos
    /**
     * 
     * @param string $table
     * @param array $column
     * @param array $where ex: array( array(coluna,sinal,valor), array(coluna, sinal, valor))
     * @return \core\pkg\dba\sql\boolean
     */
    public function getAllArray( $object, $where = array() )
    {
        $this->object = &$object;
        $doc = new \core\dba\persistencia\PHPDoc( get_class($object) );
        $this->setTable( get_class($object) );
        
        $this->select()->column( array( $this->table => $doc->getColumn() ) );
        if( !empty( $where ) ){
            foreach ( $where as $value ){
                $this->select()->where($value[0], $value[1], $value[2]);
            }
        }
        return $this->execute();
    }
    
    /**
     * A função não funciona, pois a passagem do objeto por referência
     * altera o estado dos objetos ja armazenados na variável de retorno.
     * @param unknown $object
     * @param unknown $where
     * @return multitype:NULL
     */
    public function getAllObject( $object, $where )
    {
        //$this->object = $object;
        $classeObjeto = get_class( $object );
        $doc = new \core\dba\persistencia\PHPDoc( $classeObjeto );
        $this->setTable( $classeObjeto );
        
        $this->select()->column( array( $this->table => $doc->getColumn() ) );
        
        if( !empty( $where ) ){
            foreach ( $where as $value ){
                $this->select()->where($value[0], $value[1], $value[2]);
            }
        }
        
        foreach( $this->execute() as $vResult )
        {
            # cria um objeto para que seja armazenado no array
            $this->object = new $classeObjeto;
            
            foreach( $vResult as $atributo => $valor ){
                # carrega os atributos do objeto
                $this->object->__set($atributo, $valor);
            }
            # armazena o objeto no array
            $output[] = $this->object;
        }
        # retorna um array de objetos
        return $output;
    }
    
    private function setAttributes( $result )
    {
        foreach( $result as $vResult )
            foreach( $vResult as $kvResult => $vvResult )
                $this->object->__set($kvResult, $vvResult);
    }# setAttributes
    
    public function save( $object )
    {
        $classeObjeto = get_class( $object );
        $doc = new \core\dba\persistencia\PHPDoc( $classeObjeto );
        $this->setTable( $classeObjeto );
        
        return $doc->getProperties();
        
        
    }
    
    public function delete()
    {
        
    }
    
    /**
     * Método para extrair a classe da representação pelo namespace
     * o formato da classe contempla todos os diretórios, por exemplo: app\model\Classe
     * @param string $class - formato: app\model\Classe
     */
    private function setTable( $class )
    {
        # cria um array com o namespace da classe
        $class = explode('\\', $class );
        # recupera o último elemento do array formado, ou seja a classe. Ex: array(app, model, Classe)
        $this->table =  PREFIX_TABLE .end( $class );
    }
}

?>

