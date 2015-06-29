<?php
namespace app\controllers;

class Index
{
    public function __construct( $action )
    {
        echo '<p>estou no controlador do /';
        
        if( is_null( $action ) )
            $this->home();
    }
    
    public function home()
    {
        echo '<p>Não há action definida, exeutando action padrão da aplicação';
    }
    
}

?>