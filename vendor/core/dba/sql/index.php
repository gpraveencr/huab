<?php

session_start();

header("Content-Type: text/html; charset=utf-8",true);

set_time_limit(2000);

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('html_errors', true);

date_default_timezone_set('America/Recife');

function debug( $file, $line, $dados, $titulo = "" ){

    echo "<br><font color=\"#FF0033\">  <strong>".$titulo."</strong>: (file): ".$file." - (line): ".$line."</font>";

    if( is_array( $dados ) or (is_object($dados))){
        echo "<pre><font color=\"#0000FF\">";
        print_r( $dados );
        echo "</font></pre>";
    }else{
        echo "<br><font color=\"#0000FF\">".$dados."</font><br>";
    }
}

define('ACESSO', true);


#include_once '../pdo2/Conexao.class.php';
use pkg\pdo2\Conexao;
use pkg\sql;

include_once '../pdo/Conexao.php';
include_once '../../sql/SQL.class.php';

$oCon = new Conexao('mysql', 'localhost', 'frmkteste', 'root', '312487');

$sql = new SQL( $oCon   );

$sql->select()->column->add( array( 'idCliente', 'nome', 'idade' ) );

#array("tabela" => (campo1, campo2, campo3 ) )

$sql->select()->where("idade", ">", "10");

#$sql->select()->having("altura", ">", "50");

#$sql->select("select * from tab_Cliente");

#echo $sql->select()->execute();

debug(__FILE__, __LINE__, $sql->execute() );

echo $sql->select()->table(array('tab_Cliente' => array('nome','idade'), 'tab_Telefone' => array('idTelefone','telefone')));

echo "<p>";



?>