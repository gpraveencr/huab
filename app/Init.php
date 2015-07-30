<?php
namespace app;

use core\url\Url;

/* CONTROLADOR DA APLICAÇÃO
 * - define qual controlador deve ser acionado para tratamento da requisição
 * 
 * @author elson
 *
 */
class Init
{
    
    public function __construct( $route )
    {
        $this->run( $route );
    }
    
    /**
     * Método responsável pela instância do controlador
     * associado a uma deterinada rota. Todo controlador
     * recebe como parâmetro uma action, que é o gatilho
     * para determinar o método do controlador dará
     * tratamento da requisição.
     * @param array $route
     */ 
    public function run( array $route )
    {
        if( key_exists('action', $route) ){
            $action = $route['action'];
        }elseif( key_exists('a', Url::parseURL() ) ){
            $a = Url::parseURL();
            $action = $a['a'];
        }else{
            $action = null;
        }
    
        # define o namespace do controlador
        $Controller = '\\app\\controllers\\'.ucfirst($route['controller']);
    
        # cria uma instância do controlador
        new $Controller( $action );
    }# run
    
}# Init

?>