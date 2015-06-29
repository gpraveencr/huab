<?php
namespace vendor\init;

class Route
{
    public function initRoute()
    {
        $route['/'] = array('route'=>'app', 'controller'=>'Index', 'action'=>'home');
        
        $route['pop'] = array('route'=>'app', 'controller'=>'Pop');
        
        return $route;
    }# initRoute
    
}

?>