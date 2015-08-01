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
        
        echo '<a href="'.\core\url\Url::setURL("pop","frm").'" target="_blank">Cadastrar POP</a>';
        echo "<br>";
        echo '<a href="'.\core\url\Url::setURL("pop","lista").'" target="_blank">Listar POP cadastrado</a>';
        echo "<p>";
        echo '<a href="'.\core\url\Url::setURL("agenda").'" target="_blank">Agenda</a>';
        echo "<br>";
        echo '<a href="'.\core\url\Url::setURL("agenda","frm").'" target="_blank">Reservar Sala</a>';
        echo "<br>";
        echo '<a href="'.\core\url\Url::setURL("agenda","lista").'" target="_blank">Listar reservas</a>';
    }
    
}

?>