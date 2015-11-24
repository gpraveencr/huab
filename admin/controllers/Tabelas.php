<?php
namespace admin\controllers;

class Tabelas
{
    
    public function __construct( $action )
    {
        
        if( method_exists($this, $action) ){
            
            $this->$action();
            
        }elseif( is_null( $action ) ){
            
            $this->main();
            
        }else{
            # exceção - deve haver tratamento
            debug( __FILE__, __LINE__, "variável action não definida - fazer tratamento de exceção" );
            
        }
        
    }# __construct
    
    /**
     * main é o action padrão do módulo, todo módulo
     * deve possuir uma ação padrão para redirecionamento.
     */
    private function main()
    {
        echo '<p>Não há action definida, executando action padrão da aplicação - admin';
    }# home
    
    
    private function tabelas()
    {
        $oCon = new \core\dba\pdo\Conexao( DRIVER, HOST, "information_schema", USERNAME, PASSWD );
    
        $oTabelas = new \admin\models\Tabelas($oCon);
        
        $listaTabelas = $oTabelas->getTables( DRIVER );
        
        # ---------------------------------------
        # DEFINIR AQUI OS METADADOS DA GUI, POR EXEMPLO BIBLIOTECA JS E CSS ESPECÍFICOS
        # INCLUIR OS METADADOS ESPECÍFICOS DA PÁGINA, LEMBRAR Q A AREA DE AMINISTRAÇÃO
        # DEVE POSSUIR RESTRIÇÕES DE METADADOS E NÃO PODE SER INDEXADA
        # ---------------------------------------
        
        $script = '<script src="'.BASEURL.'/public/lib/dhtmlxSuite_v44_std/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>';
        
        include_once $this->_include( __CLASS__, __METHOD__);
    
    }# tab
    
    
    private function table()
    {
        
    }
    
    public function _include( $_class, $_method )
    {
        # obter array com os dados da classe
        $class  = explode('\\', strtolower($_class));
        # obter o nome da classe
        $class  = array_pop($class);
        # obter array com dados do método
        $method = explode('::', strtolower($_method));
        # incluir arquivo
    
        $view = 'admin/views/'.$class.'/'.$class.'.'.array_pop($method).'.php';
    
        if( file_exists($view) ){
            return $view;
        }else{
    
            echo "arquivo não encontrado!";
            die();
    
        }
    }# _include
    
}# Tabelas

?>