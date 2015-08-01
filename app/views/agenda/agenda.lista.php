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
    "id Agenda",
    "titulo",
    "Data",
    "Hora inicial",
    "Hora final",
));
foreach ($pAgenda->getAllArray() as $key => $agenda) {
    $table->body(array(
        $agenda["idAgenda"],
        $agenda["titulo"],
        $agenda["data"],
        $agenda["horaInicial"],
        $agenda["horaFinal"],
        '<a href="'.\core\url\Url::setURL("agenda","edt",array($agenda['idAgenda'], $agenda['titulo']) ).'" target="_blank">editar</a>',
        '<a href="'.\core\url\Url::setURL("agenda","rm",array($agenda['idAgenda'], $agenda['titulo']) ).'" target="_parent">excluir</a>'
    ));
}
echo $table->getTable();

?>
</body>
</html>