<?php

namespace vendor\init;

/*
 * essa classe decide qual rota a aplicação deve seguir
 * e qual controller deve ser usado para tratamento
 * da requisição;
 * realiza o tratamento de rotas e controla as exceções quando 
 * a rota não for encontrada.
 */
 
require_once 'vendor/init/Route.php';

class Bootstrap
{
    private $route = array();
    
    public function __construct($modulo)
    {
        # criar uma instância do objeto de rotas
        $route = new Route();
        
        # carregar as rotas
        $this->setRoute($modulo, $route->initRoute());
    }# __construct
    
    public function setRoute($route, array $arrayRoute)
    {
        if( key_exists($route, $arrayRoute)){
            $this->route = $arrayRoute[$route];
        }else{
            header("location: ".\core\url\Url::setURL("error"));
        }
    }# setRoute
    
    public function getRoute()
    {
        return $this->route;
    }# getRoute
    
}# Bootstrap

?>