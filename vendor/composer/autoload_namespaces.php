<?php

// autoload_namespaces.php @generated by Composer

# localização do diretório "vendor" ex: /home/elson/www/projeto/vendor
$vendorDir = dirname(dirname(__FILE__)); 

# localização do diretório do projeto: ex /home/elson/www/projeto
$baseDir = dirname($vendorDir);

return array(
    'core' => array($vendorDir), #core localizado no diretório vendor
    'app' => array($baseDir . '/'), #app localizado no diretório base
    'admin' => array($baseDir . '/'), #admin localizado no diretório base
);


