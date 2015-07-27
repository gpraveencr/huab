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
    
    /**
     * O método iniRoute recebe o array de rotas registradas
     * e o módulo requerido pela URL. Se o módulo estiver registrado
     * como a chave de uma rota a função recupera todas as características
     * da rota (ex: array('route'=>'app', 'controller'=>'Pop');). Essas
     * características contém a rota e o controlador responsável pelo 
     * tratamento dos dados.
     * @param string $modulo
     * @param array $arrayRoute
     */
    public function setRoute($modulo, array $arrayRoute)
    {
        # 1 - verificar se o módulo está registrado na tabela de rotas
        # 2 - se registrado, definir os dados da rota.
        # 3 - se não registrado, redirecionar para uma tela de erro,
        # pois a requisição é inválida.
        if( key_exists($modulo, $arrayRoute)){
            $this->route = $arrayRoute[$modulo];
        }else{
            header("location: ".\core\url\Url::setURL("error"));
        }
    }# setRoute
    
    /**
     * Recupera o array de dados de uma determinada rota
     * @return array array('route'=>'app', 'controller'=>'App');
     */
    public function getRoute()
    {
        return $this->route;
    }# getRoute
    
}# Bootstrap

?>