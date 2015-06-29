<?php
namespace vendor\init;

/*
 * essa classe decide qual rota a aplicação deve seguir
 * e qual controller deve ser usado para tratamento
 * da requisição;
 */
 
include_once 'vendor/init/Route.php';

class Bootstrap
{
    private $route = array();
    
    public function __construct($route)
    {
        $initRoute = new Route();
        
        $this->setRoute($route, $initRoute->initRoute());
        
    }
    
    public function setRoute( $route, array $arrayRoute )
    {
        if( key_exists($route, $arrayRoute)){
            $this->route = $arrayRoute[$route];
        }else{
            echo "<h1>ERROR 404 - Page not found</h1>";
            die();
        }
    }
    
    public function getRoute()
    {
        return $this->route;
    }# getRoute
    
    private function pageNotFound(){
        
    }
    
}# Bootstrap

?>