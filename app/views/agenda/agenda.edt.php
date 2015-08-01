<?php 
use core\url\Url;
$html = new \core\html\Html();

?>
<html>
<head>
<title><?php echo __FILE__;?></title>
<!-- Place inside the <head> of your HTML -->

<script type="text/javascript" src="../../huab/public/lib/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    language : 'pt_BR',
    theme : 'modern',
    custom_undo_redo_levels: 10,
    font_formats: "Andale Mono=andale mono,times;"+
    "Arial=arial,helvetica,sans-serif;"+
    "Arial Black=arial black,avant garde;"+
    "Book Antiqua=book antiqua,palatino;"+
    "Comic Sans MS=comic sans ms,sans-serif;"+
    "Courier New=courier new,courier;"+
    "Georgia=georgia,palatino;"+
    "Helvetica=helvetica;"+
    "Impact=impact,chicago;"+
    "Symbol=symbol;"+
    "Tahoma=tahoma,arial,helvetica,sans-serif;"+
    "Terminal=terminal,monaco;"+
    "Times New Roman=times new roman,times;"+
    "Trebuchet MS=trebuchet ms,geneva;"+
    "Verdana=verdana,geneva;"+
    "Webdings=webdings;"+
    "Wingdings=wingdings,zapf dingbats",
    //fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
    force_hex_style_colors : true,
    color_picker_callback: function(callback, value) {
        callback('#FF00FF');
    },
    
    plugins: "table",
    table_grid: false,
    table_tab_navigation: false,

    plugins: "image",
    image_description: true,
    images_upload_base_path: "/some/basepath",
    images_upload_url: "../../postAcceptor.php"
        
 });
</script>


</head>
<body>

<form action="<?=Url::setURL("pop","add")?>" method="POST">
<input type="hidden" name="idPop" value="<?=$oPop->__get('idPop')?>">
<p>
<label for="tipoDocumento">Tipo de Documento:</label>
<input type="text" name="tipoDocumento" id="tipoDocumento" value="<?=$oPop->__get('tipoDocumento')?>">
</p>
<p>
<label for="codificacao">Codificação: </label>
<input type="text" name="codificacao" id="codificacao" value="<?=$oPop->__get('codificacao')?>" size="100%">
</p>
<p>
<label for="dataEmissao">Data de emissão: </label>
<input type="date" name="dataEmissao" id="dataEmissao" value="<?=$oPop->__get('dataEmissao')?>">
</p>
<p>
<label for="dataRevisao">Data de Revisão: </label>
<input type="date" name="dataRevisao" id="dataRevisao" value="<?=$oPop->__get('dataRevisao')?>" >
</p>
<p>
<label for="substDocAnterior">Substitui Doc Anterior?: </label>
<?php echo $html->select()->add2("substDocAnterior", array(array("S", "Sim"), array("N", "Não") ), 0, 1,null, array($oPop->__get('substDocAnterior')) )?>
</p>

<p>
<label for="elaboradoPor">Elaborado por: </label>
<input type="text" name="elaboradoPor" id="elaboradoPor" value="<?=$oPop->__get('elaboradoPor')?>">
</p>
<p>
<label for="revisadoPor">Revisado por: </label>
<input type="text" name="revisadoPor" id="revisadoPor" value="<?=$oPop->__get('revisadoPor')?>">
</p>
<p>
<label for="aprovadoPor">Aprovado por: </label>
<input type="text" name="aprovadoPor" id="aprovadoPor" value="<?=$oPop->__get('aprovadoPor')?>">
</p>
<p>
<label for="situacao">Situação: </label>
<input type="text" name="situacao" id="situacao" value="<?=$oPop->__get('situacao')?>">
</p>

<label for="pop">POP: </label>
<textarea class="txt" name="pop"><?=$oPop->__get('pop')?></textarea>

<input type="hidden" name="idCabecalho" value="1">

<p>
<input type="submit" name="edt" value="Gravar">

</form>
</body>
</html>