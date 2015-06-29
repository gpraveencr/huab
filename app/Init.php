<?php
namespace app;

use vendor\core\url\Url;

/* CONTROLADOR DA APLICAÇÃO
 * - define qual controlador deve ser acionado para tratamento da requisição
 * 
 * @author elson
 *
 */
class Init
{
    private $controller;
    private $route;
    
    public function __construct( $route )
    {
        $this->route = $route;
        $controller = $this->run();
    }
    
    
    public function run()
    {
        # verificação da action
        if( key_exists('action', $this->route) ){
            $action = $this->route['action'];
        }elseif( key_exists('a', Url::parseURL() ) ){
            $a = Url::parseURL();
            $action = $a['a'];
        }else{
            $action = null;
        }
        
        # define o namespace do controlador
        $controlador = '\\app\\controllers\\'.ucfirst($this->route['controller']);
        # instância do controlador
        $controller = new $controlador( $action );
        
        /*
        # definição da action
        if( !is_null( $action ))
            $controller->{$action}();
            */
    }
    
}# Init

?>