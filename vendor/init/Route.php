<?php

namespace vendor\init;

class Route
{
    public function initRoute()
    {
        
        # ROTAS DA ÁREA DE ADMINISTRAÇÃO DO SISTEMA
        # ROTAS DA APLICAÇÃO
        $modulo['/'] =       array('route'=>'app', 'controller'=>'Index', 'action'=>'home');
        
        $modulo['pop'] =     array('route'=>'app', 'controller'=>'Pop');
        
        $modulo['error'] =   array('route'=>'app', 'controller'=>'Error');
        
        $modulo['agenda'] =  array('route'=>'app', 'controller'=>'Agenda');
        
        $modulo['gantt'] =  array('route'=>'app', 'controller'=>'Dxhtml');
        
        # quando for a rota do diretório base, definir action como null
        $modulo['admin'] =  array('route'=>'admin', 'controller'=>'Tabelas');
        
        return $modulo;
    }# initRoute
    
}# Route

?>