<?php
namespace app\controllers;

#use vendor\core\dba\persist\Persistencia;

use vendor\core\url\Url;

class Pop
{
    private $oCon;
    
    public function __construct( $action )
    {
        if( is_null( $action ) ){
            $this->home();
        }else{
            $this->$action();
        }
            
    }
    
    private function home()
    {
        echo '<p>Não há action definida, exeutando action padrão da aplicação';
    }
    
    public function frm()
    {
        $class = explode('\\', strtolower(__CLASS__));
        $class = array_pop($class);
        $method = explode('::', strtolower(__METHOD__));
        include_once 'app/views/'.$class.'/'.$class.'.'.array_pop($method).'.php';
    }
    
    public function add()
    {
        
    }
    
    public function show()
    {
        $oCon = new \core\dba\pdo\Conexao( DRIVER, HOST, DBNAME, USERNAME, PASSWD );
        
        $persistencia = new \core\dba\persistencia\Persistencia( $oCon );
        
        $url = Url::parseURL();
        
        /*
         * fazer tratamento do ID
         */
        
        $oPop = new \app\models\Pop($persistencia, array('idPop'=>$url['id']));
        
        $class = explode('\\', strtolower(__CLASS__));
        $class = array_pop($class);
        $method = explode('::', strtolower(__METHOD__));
        include_once 'app/views/'.$class.'/'.$class.'.'.array_pop($method).'.php';
    }
    
    public function rm()
    {
        $class = explode('\\', strtolower(__CLASS__));
        $method = explode('::', strtolower(__METHOD__));
        echo 'app/views/'.array_pop($class).'.'.array_pop($method).'.php';
    }
    
    public function edt()
    {
        $class = explode('\\', strtolower(__CLASS__));
        $method = explode('::', strtolower(__METHOD__));
        echo 'app/views/'.array_pop($class).'.'.array_pop($method).'.php';
    }
    
    public function lista()
    {
        $class = explode('\\', strtolower(__CLASS__));
        $method = explode('::', strtolower(__METHOD__));
        echo 'app/views/'.array_pop($class).'.'.array_pop($method).'.php';
    }
}

?>