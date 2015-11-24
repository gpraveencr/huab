<?php
namespace app\controllers;

/*
 * - o bootstrap trata as exceções de rota (modulo)
 * - o controlador deve tratar as exceções de action
 */
 
use core\url\Url;

class Agenda
{
    private $oCon;
    
    public function __construct( $action )
    {
        # é necessário validar o action da aplicação (importante)
        if( is_null( $action ) ){
            $this->main();
        }else{
            $this->$action();
        }
    }# __construct
    
    /**
     * main é o action padrão do módulo, todo módulo
     * deve possuir uma ação padrão para redirecionamento.
     */
    private function main()
    {
        $url = Url::parseURL();
        
        $oCon = new \core\dba\pdo\Conexao( DRIVER, HOST, DBNAME, USERNAME, PASSWD );
        
        $oAgenda = new \app\models\Agenda();
        
        $pAgenda = new \app\models\AgendaPersist($oCon, $oAgenda);
        
        include_once $this->_include(__CLASS__,__METHOD__);
    }# home
    
    
    private function teste()
    {
        include_once "public/lib/dhtmlxScheduler_v4.3.1/codebase/connector/scheduler_connector.php";
    
        //nclude_once $this->_include(__CLASS__,__METHOD__);
    }# home
    
    private function dhtmlreadonly()
    {
        $url = Url::parseURL();
    
        $oCon = new \core\dba\pdo\Conexao( DRIVER, HOST, DBNAME, USERNAME, PASSWD );
    
        $oAgenda = new \app\models\Agenda();
    
        $pAgenda = new \app\models\AgendaPersist($oCon, $oAgenda);
    
        include_once $this->_include(__CLASS__,__METHOD__);
    }# home
    
    private function maps()
    {
        include_once $this->_include(__CLASS__,__METHOD__);
    }
    
    /**
     * action FRM
     * retorna um formulário de entrada de dados
     */
    public function frm()
    {
        $class  = explode('\\', strtolower(__CLASS__));
        $class  = array_pop($class);
        $method = explode('::', strtolower(__METHOD__));
        include_once 'app/views/'.$class.'/'.$class.'.'.array_pop($method).'.php';
    }# home
    
    /**
     * action ADD
     * adiciona um novo registro no banco de dados
     */
    public function add()
    {
        
        $oCon = new \core\dba\pdo\Conexao( DRIVER, HOST, DBNAME, USERNAME, PASSWD );
        
        $oAgenda = new \app\models\Agenda();
        
        $doc = new \core\dba\persistencia\PHPDoc(get_class($oAgenda));
        
        foreach( $doc->getColumn() as $column ){
            if( isset($_POST[$column]) ){
                $oAgenda->__set($column, $_POST[$column]);
                debug(__FILE__, __LINE__, $column);
            }
        }
        
        $pAgenda = new \app\models\AgendaPersist($oCon, $oAgenda);
        

        if( isset( $_POST["frm"] ) ){
            
            $pAgenda->save("insert");
            
            if( !is_null( $doc->getAutoincrement() ) ){
                
                $oAgenda->__set($doc->getAutoincrement(), $pAgenda->lastInsertId());
                
                header("location: ".Url::setURL("agenda","dhtmlreadonly"));
                //header("location: ".Url::setURL("agenda","show",array($oAgenda->__get($doc->getAutoincrement()),"insert: pk do tipo auto_increment")));
            }else{
                header("location: ".Url::setURL("agenda","show",array($oAgenda->__get("idAgenda"),"insert: pk gerada pelo usuario ou algoritmo")));
            }
            
        }elseif( isset( $_POST["edt"] ) ){
            # o update não suporta autalização de chave primária
            
            $pAgenda->save("update");
            
            header("location: ".Url::setURL("agenda","show",array($oAgenda->__get("idAgenda"),"update")));
            
        }else{
            # tratamento caso os campos submit não contenham os nomes padrões frm ou edt
        }
    }# add
    
    /**
     * action SHOW
     * retorna um formulário para visualização de dados
     * - cada consulta deve retornar, apenas, 1 registro referente ao objeto instanciado
     */
    public function show()
    {
        # - recuperar a URL
        $url = Url::parseURL();
        
        # - estabeler conexão com o banco de dados
        $oCon = new \core\dba\pdo\Conexao( DRIVER, HOST, DBNAME, USERNAME, PASSWD );
        
        # - instanciar um objeto do modelo de acordo com o Id
        $oAgenda = new \app\models\Agenda( array("idAgenda" => $url['id']) );
        
        # - instanciar um objeto persistente
        $pAgenda = new \app\models\AgendaPersist( $oCon, $oAgenda );
        
        $pAgenda->getObject();
        
        
        /*
         * Número de linhas retornadas
         * 0 = não foram encontrados registros
         * 1 = OK
         * > 1 = inconsistência na consulta, retornar página de erro, registrar em log e informar ao administrador do sistema.
         * 
         * Essa action suporta apenas 1 registro como resultado da pesquisa, caso
         * a consulta retorne mais de 1 registro, deve receber tratamento adequado
         * e o erro deve ser reportado ao administrador (registro de log)
         */
        switch ( $pAgenda->getNumberRows() ){
            case 0: # nenhum registro encontrado
                # redirecionar para uma pagina de erro
                echo "<h1>ERROR 404 - Nenhum registro encontrado - ".__CLASS__."(".__LINE__.")</h1>";
                die();
                break;
                
            case 1: # saida padrão quando um registro for encontrado
                
                # mostar a página com o registro solicitado
                $class = explode('\\', strtolower(__CLASS__));
                $class = array_pop($class);
                $method = explode('::', strtolower(__METHOD__));
                include_once 'app/views/'.$class.'/'.$class.'.'.array_pop($method).'.php';
                break;
                
                default: # inconsistência na consulta, possivelmente erro na clausula where
                    
                    # mostrar a página de erro e registrar em log
                    echo "<h1>ERROR 404 - Inconsistência na consulta, registrar erro no log - ".__CLASS__."(".__LINE__.")</h1>";
                    die();
                    break;
        }# switch
        
    }# show
    
    /**
     * action RM
     * remove um registro do banco de dados
     */
    public function rm()
    {
        # - recuperar a URL
        $url = Url::parseURL();
        
        # - estabeler conexão com o banco de dados
        $oCon = new \core\dba\pdo\Conexao( DRIVER, HOST, DBNAME, USERNAME, PASSWD );
        
        # - instanciar um objeto do modelo de acordo com o Id
        $oAgenda = new \app\models\Agenda( array("idAgenda" => $url['id']) );
        
        # - instanciar um objeto persistente
        $pAgenda = new \app\models\AgendaPersist($oCon, $oAgenda);
        
        $pAgenda->removeObject();
        
        header("location: ".Url::setURL("agenda","lista"));
        
        $class = explode('\\', strtolower(__CLASS__));
        $class = array_pop($class);
        $method = explode('::', strtolower(__METHOD__));
        include_once 'app/views/'.$class.'/'.$class.'.lista.php';
    }# rm
    
    /**
     * action EDT
     * retorna um formulário para edição de dados
     */
    public function edt()
    {
        # - recuperar a URL
        $url = Url::parseURL();
        
        # - estabeler conexão com o banco de dados
        $oCon = new \core\dba\pdo\Conexao( DRIVER, HOST, DBNAME, USERNAME, PASSWD );
        
        # - instanciar um objeto do modelo de acordo com o Id
        //$oPop = new \app\models\Pop( $url['id'] );
        $oAgenda = new \app\models\Agenda( array("idAgenda" => $url['id']) );
        
        
        # - instanciar um objeto persistente
        $pAgenda = new \app\models\AgendaPersist($oCon, $oAgenda);
        
        # - recuperar os atributos do objeto
        $pAgenda->getObject();
        
        # - verificar se 
        /*
         * Essa action suporta apenas 1 registro como resultado da pesquisa, caso
         * a consulta retorne mais de 1 registro, deve receber tratamento adequado
         * e o erro deve ser reportado ao administrador (registro de log)
         */
        if( !$pAgenda->getNumberRows() ){
            echo "<h1>ERROR 404 - Nenhum registro encontrado - ".__CLASS__."(".__LINE__.")</h1>";
            die();
            
        }
        
# centralizar o código numa classe de acesso centralizado
        $class = explode('\\', strtolower(__CLASS__));
        $class = array_pop($class);
        $method = explode('::', strtolower(__METHOD__));
        include_once 'app/views/'.$class.'/'.$class.'.'.array_pop($method).'.php';
    }# edt
    
    public function lista()
    {
        $url = Url::parseURL();
        
        $oCon = new \core\dba\pdo\Conexao( DRIVER, HOST, DBNAME, USERNAME, PASSWD );
        
        $oAgenda = new \app\models\Agenda();
        
        $pAgenda = new \app\models\AgendaPersist($oCon, $oAgenda);
        
        include_once $this->_include(__CLASS__,__METHOD__);
    }# lista
    
    
    public function _include( $_class, $_method )
    {
        # obter array com os dados da classe
        $class  = explode('\\', strtolower($_class));
        # obter o nome da classe
        $class  = array_pop($class);
        # obter array com dados do método
        $method = explode('::', strtolower($_method));
        # incluir arquivo
        
        $view = 'app/views/'.$class.'/'.$class.'.'.array_pop($method).'.php';
        
        if( file_exists($view) ){
            return $view;
            #include_once 'app/views/'.$class.'/'.$class.'.'.array_pop($method).'.php';
            
        }else{
            
            echo "arquivo não encontrado!";
            die();
            
        }
    }# _include
    
}# Pop

?>