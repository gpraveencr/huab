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
$table->head(array(
    "id",
    "Codificação",
    "Data emissão",
    "Elaborado Por",
    "Revisado por",
    "Aprovado por",
    "editar",
    "excluir"
));
foreach ($pPop->getAllArray() as $key => $pop) {
    $table->body(array(
        $pop["idPop"],
        $pop["codificacao"],
        $pop["dataEmissao"],
        $pop["elaboradoPor"],
        $pop["revisadoPor"],
        $pop["aprovadoPor"],
        '<a href="'.\core\url\Url::setURL("pop","edt",array($pop['idPop'], $pop['codificacao']) ).'" target="_blank">editar</a>',
        '<a href="'.\core\url\Url::setURL("pop","rm",array($pop['idPop'], $pop['codificacao']) ).'" target="_parent">excluir</a>'
    ));
}
echo $table->getTable();

?>
</body>
</html>