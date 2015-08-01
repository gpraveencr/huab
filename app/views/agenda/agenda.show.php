<?php 
use core\html\Html;
?>
<html>
    <head>
        <title><?php echo __FILE__;?></title>
    </head>
<body>
<?php 

    $html = new \core\html\Html();
    $table = $html->table();
    //$table->head(array('codigo','nome','idade'));
    $table->body(array("Titulo: ".$oAgenda->__get('titulo'), "Data: ".$oAgenda->__get('data'),"Hora inicial: ".$oAgenda->__get('horaInicial'), "Hora final: ".$oAgenda->__get('horaFinal')));
    echo $table->getTable();

?>
</body>
</html>