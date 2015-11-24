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
        echo "<br>";
        echo '<a href="'.\core\url\Url::setURL("admin","tabelas").'" target="_blank">Listar tabelas</a>';
        /*
        echo "<p>";
        echo '<a href="'.\core\url\Url::setURL("agenda").'" target="_blank">Agenda</a>';
        echo "<br>";
        echo '<a href="'.\core\url\Url::setURL("agenda","frm").'" target="_blank">Reservar Sala</a>';
        echo "<br>";
        echo '<a href="'.\core\url\Url::setURL("agenda","lista").'" target="_blank">Listar reservas</a>';
        echo "<br>";
        echo '<a href="'.\core\url\Url::setURL("agenda","teste").'" target="_blank">Nova Agenda</a>';
        echo "<br>";
        echo '<a href="'.\core\url\Url::setURL("agenda","dhtmlreadonly").'" target="_blank">Agenda Apenas leitura</a>';
        
        echo "<br>";
        echo '<a href="'.\core\url\Url::setURL("agenda","maps").'" target="_blank">Google Maps</a>';
        
        echo "<p>";
        echo '<a href="'.\core\url\Url::setURL("gantt","gantt").'" target="_blank">GANTT</a>';
        echo "<p>";
        echo '<a href="'.\core\url\Url::setURL("gantt","message").'" target="_blank">MESSAGE</a>';
        */
    }
    
}

?>