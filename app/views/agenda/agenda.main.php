<!DOCTYPE html>
<html>
<head>
<title>Agenda HUAB</title>
<meta charset='utf-8' />
<link href='<?=BASEURL?>/public/lib/fullcalendar-2.3.2/fullcalendar.css' rel='stylesheet' />
<link href='<?=BASEURL?>/public/lib/fullcalendar-2.3.2/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?=BASEURL?>/public/lib/fullcalendar-2.3.2/lib/moment.min.js'></script>
<script src='<?=BASEURL?>/public/lib/fullcalendar-2.3.2/lib/jquery.min.js'></script>
<script src='<?=BASEURL?>/public/lib/fullcalendar-2.3.2/fullcalendar.min.js'></script>
<script src='<?=BASEURL?>/public/lib/fullcalendar-2.3.2/lang/pt-br.js'></script>
<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '<?=date( DateTime::ISO8601 );?>',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: [
<?php 
$contador = 1;

foreach ($pAgenda->getAllArray() as $key => $agenda) {
    echo "{";
    echo "\n\t";
    echo "id: ".$agenda["idAgenda"].",";
    echo "\n\t";
    echo "title: '".$agenda["titulo"]."',";
    echo "\n\t";
    echo "start: '".$agenda["data"]."T".$agenda["horaInicial"]."',";
    echo "\n\t";
    echo "end: '".$agenda["data"]."T".$agenda["horaFinal"]."',";
    echo "\n\t";
    echo "url: '".\core\url\Url::setURL("agenda","show",array($agenda['idAgenda'], $agenda['titulo']) )."',";
    echo "\n\t";
    if( ($contador % 2) == 0 ){
        echo "color: '#ff9f89'";
    }else{
        echo "color: '#ff4d89'";
    }    
    echo "\n";
    echo "}";
    
    if( $contador < $pAgenda->getNumberRows() )
        echo ",";
    
    echo "\n";
    
    $contador++;
}

?>				
			]
		});
		
	});

</script>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 70%;
		margin: 0 auto;
	}

</style>
</head>
<body>

	<div id='calendar'></div>

</body>
</html>