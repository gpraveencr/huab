<?php

?>

<!DOCTYPE html>
<html>
<head>
   <title>Gantt</title>
   
<script src="<?=BASEURL?>/public/lib/dhtmlxSuite_v44_std/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?=BASEURL?>/public/lib/dhtmlxSuite_v44_std/codebase/dhtmlx.css" type="text/css" title="no title">


	<script type="text/javascript">


	dhtmlx.alert("Teste de alerta", function(result){
		type:"alert-error",
        title: "Titulo do alerta",
        ok:"OK",
        text: "Text" + result

    });

	dhtmlx.confirm("texto confirm", function(result){
		title:"dhtmlx.confirm",
		ok:"Sim", cancel:"Não",
		text:"Result: "+result
	});
	
		function alerta(){
			dhtmlx.alert("Test alert", function(result){
				dhtmlx.alert({
					title:"Custom title",
					ok:"Custom text",
					text:"Result: "+result,
					callback:function(){
						dhtmlx.alert({
							type:"alert-warning",
							text:"Warning",
							callback:function(){
								dhtmlx.alert({
									title:"Important!",
									type:"alert-error",
									text:"Error"
								});
							}
						});
					}
				});
			});

		}
	</script>

</head>

<a href="#" onclick="dhtmlx.alert('teste de alerta')">DHTMLX ALERT</a>

<p>

<a href="#" onclick="dhtmlx.confirm('confirm fafafaf')">DHTMLX CONFIRM</a>
<body>
	
</body>
</html>