<!DOCTYPE html>
<html>
<head>
	<title>String templates</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<!-- BIBLIOTECA DE FUNÇÕES -->
    <?=$script;?>
    <link rel="stylesheet" href="<?=BASEURL?>/public/lib/dhtmlxSuite_v44_std/codebase/dhtmlx.css" type="text/css" title="no title">
	<style>
		div.preview_tpl {
			position: relative;
			float: left;
			padding: 5px;
			margin: 20px 20px 10px;
			border-radius: 2px;
			box-shadow: 0 0 3px rgba(0, 0, 0, 0.10);
			background-color: #fefefe;
			font-size: 13px;
			font-family: Monospace,Consolas;
			border: 1px solid #a4bed4;
		}
		div.preview_tpl div.header_tpl {
			position: absolute;
			background-color: #fff;
			border: 1px solid #a4bed4;
			padding: 4px 14px;
			left: 10px;
			top: -14px;
			box-shadow: 0 -1px 1px rgba(0, 0, 0, 0.05);
			cursor: default;
		}
		div.preview_tpl table {
			margin: 20px 30px;
		}
		div.preview_tpl td {
			font-size: 12px;
			font-family: Monospace,Consolas;
			padding: 2px 20px 2px 5px;
		}
		div.preview_tpl tr.tr_hdr_tpl td {
			border-bottom: 1px solid #a4bed4;
			padding-bottom: 8px;
		}
		div.preview_tpl tr.first_row_tpl td {
			padding-top: 7px;
		}
	</style>
	<script>
		function doOnLoad() {
			var data = {
				first_name: "Richard",
				last_name: "Wilson",
				addr1: "Upton Avenue 1870",
				addr2: "Liberty Square 4949",
				company: "Monk Home Loans"
			};
			
			var parentObj = document.getElementById("previewData");
			parentObj.innerHTML = window.dhx4.template(parentObj.innerHTML, data);
		}
	</script>
</head>
<body onload="doOnLoad();">
	<div class="preview_tpl" id="previewData">
		<div class="header_tpl">Strings</div>
		<table cellspacing="0" cellpadding="0" border="0">
			<tr class="tr_hdr_tpl"><td>Template</td><td>Key</td><td>Value</td><td>Result</td></tr>
			<tr class="first_row_tpl"><td>uppercase</td><td>first_name</td><td>#first_name#</td><td>#first_name|uppercase#</td></tr>
			<tr><td>uppercase</td><td>last_name</td><td>#last_name#</td><td>#last_name|uppercase#</td></tr>
			<tr><td>lowercase</td><td>addr1</td><td>#addr1#</td><td>#addr1|lowercase#</td></tr>
			<tr><td>lowercase</td><td>addr2</td><td>#addr2#</td><td>#addr2|lowercase#</td></tr>
			<tr><td>maxlength</td><td>company</td><td>#company#</td><td>#company|maxlength:11:true#</td></tr>
		</table>
	</div>



<?php
$table = new \core\html\Table();

$table->addAtributos("tr", array("class"=>"tr_hdr_tpl"));
$table->body( array( "Tabela","Registros", "metadados","editar" ) );

$table->addAtributos("tr", array("class"=>"first_row_tpl")); 

foreach ( $listaTabelas as $lista => $metadados ){
    $linkMetaDados = '<a href="" title="editar metadados da tabela '.$metadados['TABLE_NAME'].'">IMG META</a>';
    $linkEditar = '<a href="" title="editar dados da tabela '.$metadados['TABLE_NAME'].'">EDITAR DADOS</a>';
    $table->body(array($metadados['TABLE_NAME'], $metadados['TABLE_ROWS'], $linkMetaDados, $linkEditar));
}
 
echo '<div class="preview_tpl" id="previewData">';
echo '<div class="header_tpl">Lista de tabelas do sistema</div>';
echo $table->getTable();
echo '</div>';
?>

</body>
</html>