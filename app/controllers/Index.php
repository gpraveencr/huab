<?php
namespace app\controllers;

class Index
{
    public function __construct( $action )
    {
        if( is_null( $action ) ){
            $this->home();
        }else{
            $this->$action();
        }
            
    }
    
    public function home()
    {
        /*
         * TESTE
         */
        
        echo "<a href=\"".\core\url\Url::setURL("pop","frm")."\">Cadastrar POP</a>";
        echo "<br>";
        echo "<a href=\"".\core\url\Url::setURL("pop","lista")."\">Lisar POP cadastrado</a>";
    }
    
}

?>