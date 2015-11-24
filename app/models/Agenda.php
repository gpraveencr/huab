<?php

namespace app\models;

class Agenda
{
    /**
     * @pk
     * @column
     * @autoincrement
     */
    private $idAgenda       = null;
    
    /**
     * @column
     */
    private $titulo         = null;
    
    /**
     * @column
     */
    private $data           = null;
    
    /**
     * @column
     */
    private $horaInicial    = null;
    
    /**
     * @column
     */
    private $horaFinal      = null;
    
    /**
     * @column
     */
    private $sala      = null;
    
    /**
     * 
     * @param array $id
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
}# Pop



# ----------------------------------------------------------------
# CLASSE DE PERSISTÊNCIA
# ----------------------------------------------------------------
class AgendaPersist extends \core\dba\sql\SQL
{
    private $object;
    private $table = "tab_Agenda";

    public function __construct($oCon, $object)
    {
        parent::__construct($oCon);
        
        $this->object = &$object;
    }# __construct
    
    /**
     * Regra de negócio: esse método deve retornar apenas 1 registro
     * como resultado do banco de dados. Se retornar mais de 1 registro
     * a consulta é inválida (fatal_eror). Se não retornar registro na
     * consulta, a interface deve ser notificada.
     */
    public function getObject()
    {
        # obter a documentação da classe
        $doc = new \core\dba\persistencia\PHPDoc(get_class($this->object));
        
        # definir a tabela e os campos da consulta SQL
        $this->select()->column(array( $this->table => $doc->getColumn() ));
           
        # definir a restrição da consulta com base na chave primária (definir código para chaves múltiplas - relacionamento MxN)
        $this->select()->where("idAgenda", "=", $this->object->__get("idAgenda"));
        
        $this->setAttributes($this->execute());
        
    }# getObject
    
    /**
     *
     * @param array $where ex: array( array(coluna,sinal,valor), array(coluna, sinal, valor))
     * @return \core\pkg\dba\sql\boolean
     */
    public function getAllArray( array $where = array() )
    {
        $doc = new \core\dba\persistencia\PHPDoc(get_class($this->object));
        
        $this->select()->column( array( $this->table => $doc->getColumn() ) );
        
        if( !empty( $where ) ){
            foreach ( $where as $value ){
                $this->select()->where($value[0], $value[1], $value[2]);
            }
        }
        return $this->execute();
    }
    
    public function save( $action )
    {
        
        $doc = new \core\dba\persistencia\PHPDoc(get_class($this->object));
        
        if( $action == "insert" ){
        
            foreach($doc->getColumn() as $atributes){
        
                if( !is_null($this->object->__get($atributes)) ){
                    $columnValue[$atributes] = $this->object->__get($atributes);
                }
            }
            $this->insert()->add($columnValue, $this->table);
            
            $this->execute();
        
        }elseif( $action == "update" ){
        
            foreach($doc->getColumn() as $atributes){
        
                if( !is_null($this->object->__get($atributes)) ){
                    if( !in_array($atributes, $doc->getPK())){
                        $columnValue[$atributes] = $this->object->__get($atributes);
                    }
                }
            }
            $this->update()->add( $columnValue, array("idAgenda" => $this->object->__get("idAgenda")), $this->table);
            $this->execute();
        }
        
        /* Tratamento automatizado da função de persistência de dados
         * (if) - tratamento para tabelas com uma chave primária
         * (else) - tratamento para tabelas com mais de uma chave primaria 
         */
        if( count( $doc->getPK() ) == 1 ){
            # regra valida somente quando houver uma única chave primária
            
            /* (if) - tratamento para PK do tipo auto_increment e não nula ( define uma ação do tipo update )
             * (else) - tratamento para PK do tipo auto_increment nula ( define ação do tipo insert )
             */
            if( !is_null( $doc->getAutoincrement() ) ){
                # a chave primária é do tipo auto_increment
                if( !is_null( $this->object->__get($doc->getPK()) ) ){
                    # pk não nula, realizar update
                    
                }elseif( is_null($this->object->__get($doc->getPK()) ) ){
                    #pk nula, realizar insert
                    
                }
                
            }else{
                # chave primária gerada pelo usuário ou calculada pelo sistema
                # -> pode ser usada por entidades fracas, cuja chave primária é composta
                
                # passo 1: verificar a validade da chave (regra de negócio)
                # passo 2: consultar a base de dados para verificar a existência da chave
                # passo 3: se a chave existir na base de dados 
            }
            
            
            
        }elseif( count( $doc->getPK() ) > 1 ){
            # regra válida quando houver mais de uma chave primária
            
            
        }
        
        
        
        
        foreach($doc->getColumn() as $atributes){
        
            if( !is_null($this->object->__get($atributes)) ){
                $columnValue[$atributes] = $this->object->__get($atributes);
            }
        }
        
                
        
       
        
    }
    
    public function removeObject()
    {   
        $doc = new \core\dba\persistencia\PHPDoc(get_class($this->object));
        
        $this->delete()->add(array( "idAgenda" => $this->object->__get("idAgenda")), $this->table);
        
        $this->execute();
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
    
}# PopPersist

?>