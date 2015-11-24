<?php

?>

<!DOCTYPE html>
<html>
<head>
   <title>Gantt</title>
   
   <script src="<?=BASEURL?>/public/lib/dhtmlxSuite_v44_std/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?=BASEURL?>/public/lib/dhtmlxSuite_v44_std/codebase/dhtmlx.css" type="text/css" title="no title">
</head>


<body>
	<script type="text/javascript">
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
	</script>	
</body>
</html>