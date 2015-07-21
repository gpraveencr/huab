<?php
namespace vendor\init;

class Route
{
    public function initRoute()
    {
        
        # ROTAS DA ÁREA DE ADMINISTRAÇÃO DO SISTEMA
        
        
        
        # ROTAS DA APLICAÇÃO
        $route['/'] = array('route'=>'app', 'controller'=>'Index', 'action'=>'home');
        
        $route['pop'] = array('route'=>'app', 'controller'=>'Pop');
        
        $route['error'] = array('route'=>'app', 'controller'=>'Error');
        
        # tratamento de erros do sistema
        //$route['error'] = array('route'=>'admin', 'controller'=>'Error');
        
        return $route;
    }# initRoute
    
}

?>