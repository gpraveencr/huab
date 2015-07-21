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
     * Método para recuperar um objeto do banco através do mapeamento
     * objeto relacional. A classe PHPDoc recupera os atributos da classe
     * 
     * @param string $table
     * @param array $column
     * @param array $identificador ex: array(array( 'campo' => 'valor' );
     */
    public function getObject( $object )
    {
        $this->object = &$object;
        $doc = new \core\dba\persistencia\PHPDoc( get_class($object) );
        
        /*
         * Define 
         */
        $this->setTable( get_class($object) );
        
        $this->select()->column( array( $this->table => $doc->getColumn() ) );
        
        foreach ( $doc->getPK() as $pk )
            if( !is_null( $this->object->__get( $pk ) ) )
                $this->select()->where( $pk, "=", $this->object->__get( $pk ) );
            
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
        
        foreach( $this->execute() as $vResult ){
            # cria um objeto para que seja armazenado no array
            $this->object = new $classeObjeto;
            
            foreach( $vResult as $atributo => $valor ){
                # carrega os atributos do objeto
                $this->object->__set($atributo, $valor);
            }
            # armazena o objeto no array
            $output[] = $this->object;
            $this->object = null;
        }
        # retorna um array de objetos
        return $output;
    }
    
    /**
     * Função para carregar os atributos de um objeto nos métodos
     * getObject e getAllObject. Recebe como parâmetro o resultado
     * de um consulta ao banco de dados e logo após define os atributos
     * do objeto. O nome do atributo da classe deve ser igual ao nome do 
     * atributo da tabela.
     * @param array $result
     */
    private function setAttributes( array $result )
    {
        foreach( $result as $vResult )
            foreach( $vResult as $kvResult => $vvResult )
                $this->object->__set( $kvResult, $vvResult );
    }# setAttributes
    
    /**
     * Método para alterar o estado de um objeto e persistir no banco de dados.
     * 
     * obs: esse método deve recuperar o estado anterior do objeto, comparar
     * com o estado atual e realizar o insert dos novos dados, update dos dados
     * alterados e delete dos dados excluídos. Deve ser elaborado um padrão para
     * que as operações sejam transparentes e reaproveitadas para cada classe.
     * @param unknown $object
     */
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
     * Método para mapeamento objeto-relacional que recupera
     * o nome tabela vinculada a classe. A tabela segue a regra
     * prefixo + nome da classe. Ex: tab_Customer
     * A classe passada no parâmetro deve seguir a nomenclatura 
     * do namespace atribuido na PSR0.
     * Ex: \dir\subdir\Class
     * @param string $class
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

