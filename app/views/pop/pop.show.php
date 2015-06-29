<html>
<head>
<title><?php echo __FILE__;?></title>
<!-- Place inside the <head> of your HTML -->

<script type="text/javascript" src="../../public/lib/tinymce/js/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
</script>
</head>

<label for="id"> id: <input type="text" name="id" id="id" value="<?=$oPop->__get('idPop')?>"></label>
<br>
<label for="tarefa">Tarefa: <input type="text" name="tarefa" id="tarefa" value="<?=$oPop->__get('tarefa')?>"></label>
<br>
<label for="atividades">Atvididades; <textarea rows="50" cols="50" name="atividades" id="atividades"><?=$oPop->__get('atividades')?></textarea></label>
<br>
</html>