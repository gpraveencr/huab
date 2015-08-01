<?php 
use core\url\Url;
$html = new \core\html\Html();
?>
<html>
<head>
<title><?php echo __FILE__;?></title>
<!-- Place inside the <head> of your HTML -->

</head>
<body>

<form action="<?=Url::setURL("agenda","add")?>" method="POST">

<p>
<label for="titulo">Título:</label>
<input type="text" name="titulo" id="titulo" value="teste da agenda">
</p>

<p>
<label for="data">Data: </label>
<input type="date" name="data" id="data" value="" size="100%">
</p>

<p>
<label for="horaInicial">Início: </label>
<input type="time" name="horaInicial" id="horaInicial" value="" >
</p>

<p>
<label for="horaFinal">Término: </label>
<input type="time" name="horaFinal" id="horaFinal" value="">
</p>

<p>
<input type="submit" name="frm" value="Gravar">

</form>
</body>
</html>