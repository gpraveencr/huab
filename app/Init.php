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
    private $route;
    
    public function __construct( $route )
    {
        $this->route = $route;
        $this->run();
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
        $controller = '\\app\\controllers\\'.ucfirst($this->route['controller']);
        
        # instância do controlador
        new $controller( $action );
    }# run
    
}# Init

?>