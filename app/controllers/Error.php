<?php

namespace app\controllers;

class Error
{
    
    public function __construct($action)
    {
        $this->error();
    }

    
    public function error()
    {
        $class = explode('\\', strtolower(__CLASS__));
        $class = array_pop($class);
        $method = explode('::', strtolower(__METHOD__));
        include_once 'app/views/'.$class.'/'.$class.'.'.array_pop($method).'.php';
    }
}

?>
