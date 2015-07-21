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
    $table->body(array("Tipo de documento: ".$oPop->__get('tipoDocumento'), "Codificação: ".$oPop->__get('codificacao'),'pagina nº '));
    $table->body(array("Data de emissão: ".$oPop->__get('dataEmissao'),"Data de revisão: ".$oPop->__get('dataRevisao'),"Substitui Doc Anterior? ".$oPop->__get('substDocAnterior')));
    $table->body(array("Elaborado por: ".$oPop->__get('elaboradoPor'),"Revisado por: ".$oPop->__get('revisadoPor'),"Aprovado por: ".$oPop->__get('aprovadoPor')));
    $table->addAtributos('td', array('colspan'=>'3'), 1);
    $table->body(array($oPop->__get('pop')));
    echo $table->getTable();

?>
</body>
</html>