<?php

namespace app\controllers;

use core\url\Url;

class Dxhtml
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
    
    public function gantt()
    {
        //$res=mysql_connect("localhost","root","312487");
        $res = mysqli_connect("localhost", "root", "312487", "huab");
        
        
        $url = Url::parseURL();
        
        $oCon = new \core\dba\pdo\Conexao( DRIVER, HOST, DBNAME, USERNAME, PASSWD );
        
        //$oAgenda = new \app\models\Agenda();
        
        //$pAgenda = new \app\models\AgendaPersist($oCon, $oAgenda);
        
        
        //mysql_select_db("gantt");
        
        include "public/lib/dhtmlxScheduler_v4.3.1/codebase/connector/gantt_connector.php";
        
        $gantt->render_links("gantt_links","id","source,target,type");
        
        $gantt->render_table(
            "gantt_tasks",
            "id",
            "start_date,duration,text,progress,sortorder,parent"
        );
        
        
        include_once $this->_include(__CLASS__,__METHOD__);
        
    }# gantt
    
    public function message()
    {
        include_once $this->_include(__CLASS__,__METHOD__);
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
    
        $view = 'app/views/'.$class.'/'.$class.'.'.array_pop($method).'.php';
    
        if( file_exists($view) ){
            return $view;
            #include_once 'app/views/'.$class.'/'.$class.'.'.array_pop($method).'.php';
    
        }else{
    
            echo "arquivo não encontrado!";
            die();
    
        }
    }# _include
}

?>