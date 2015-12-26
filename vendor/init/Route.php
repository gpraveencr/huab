<?php

namespace vendor\init;

/**
 * 
 * A classe Route armazena as rotas definidas na aplicação (app ou admin), o controlador da rota
 * e quando o diretório for / define o action padrão. 
 * Obs: creio que o action, apenas, deve ser definido para o diretório /, pois ao definir o
 * action no arquivo de rotas, o controlador Init sempre instanciará esse action.
 * Para que o action seja interpretado pela URL, ele não deve ser definido aqui.
 * @author Elson Vinicius
 */
class Route
{
    public function initRoute()
    {
        
        # ROTAS DA ÁREA DE ADMINISTRAÇÃO DO SISTEMA
        # ROTAS DA APLICAÇÃO
        
        # define a página padrão do sistema (home)
        $modulo['/']        =   array('route'=>'app', 'module'=>'index', 'controller'=>'Index', 'action'=>'home');
        
        $modulo['teste']    =   array('route'=>'app', 'module'=>'teste', 'controller'=>'Cliente');
        
        #$modulo['pop']      =   array('route'=>'app', 'controller'=>'Pop');
        
        #$modulo['error']    =   array('route'=>'app', 'controller'=>'Error');
        
        #$modulo['agenda']   =   array('route'=>'app', 'controller'=>'Agenda');
        
        #$modulo['gantt']    =   array('route'=>'app', 'controller'=>'Dxhtml');
        
        $modulo['admin']    =  array('route'=>'admin', 'controller'=>'Tabelas');
        
        return $modulo;
    }# initRoute
    
}# Route

?>