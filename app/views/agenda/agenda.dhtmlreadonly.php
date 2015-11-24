<!doctype html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">

<title>Read-only events</title>

<!-- BIBLIOTECA DE FUNÇÕES -->
<script src="<?=BASEURL?>/public/lib/dhtmlxSuite_v44_std/codebase/dhtmlx.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?=BASEURL?>/public/lib/dhtmlxSuite_v44_std/codebase/dhtmlx.css" type="text/css" title="no title">

<!-- SCHEDULLER -->
<script src="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/dhtmlxscheduler.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/dhtmlxscheduler.css" type="text/css" title="no title">

<!-- TRADUÇÃO PARA O PORTUGUES DO BRASIL -->
<script src="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/locale/locale_pt.js" type="text/javascript"></script>
<script src="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/locale/recurring/locale_recurring_pt.js" ></script>

<script src="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/ext/dhtmlxscheduler_units.js" type="text/javascript" charset="utf-8"></script>

<!-- usar fragmento na URL http://localhost/huab/agenda/teste#date=2014-01-30,mode=month -->
<!-- <script src="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/ext/dhtmlxscheduler_url.js" type="text/javascript" charset="utf-8"></script> -->

<!-- eventos para apenas leitura -->
<script	src="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/ext/dhtmlxscheduler_readonly.js" type="text/javascript" charset="utf-8"></script>

<style type="text/css" media="screen">
	html, body{
		margin:0px;
		padding:0px;
		height:100%;
		overflow:hidden;
	}	
</style>

<style type="text/css">

		.window{
			display:none;
			width:300px;
			height:300px;
			position:absolute;
			left:0;
			top:0;
			background:#FFF;
			z-index:9900;
			padding:10px;
			border-radius:10px;
		}

		#mascara{
			position:absolute;
  			left:0;
  			top:0;
  			z-index:9000;
  			background-color:#000;
  			display:none;
		}

		.fechar{display:block; text-align:right;}

		</style>

<script type="text/javascript" charset="utf-8">

function init(){
	var dhxWins, w1;
	var sections=[
	              {key:1, label:"VC01 - GEP"},
	              {key:2, label:"VC02 - Sala Video"},
	              {key:3, label:"Auditório"},
	              {key:4, label:"VC03 - Superintendência"}
	              ];
    //define o nome do botão
	scheduler.locale.labels.unit_tab = "Salas";
    scheduler.locale.labels.section_custom="Section";
	scheduler.config.xml_date="%Y-%m-%d %H:%i";
	scheduler.config.api_date="%Y-%m-%d %H:%i";
	scheduler.config.details_on_dblclick = false;
	scheduler.init("agenda","<?=date("Y-m-d");?>","week");
	
	scheduler.createUnitsView({
        name:"unit",
        property:"section_id",
        list:sections
    });

    scheduler.config.multi_day = false;
	
	function block_readonly(id){
		if (!id) return addEvento();
		return !this.getEvent(id).readonly;
	}

	function readonly_onclick(id){
		if (!id) return false;
	}

	function bloquearEvento(){
		return false;
	}
	
	//scheduler.attachEvent("onBeforeDrag",block_readonly)
	//scheduler.attachEvent("onClick",readonly_onclick)
	//scheduler.attachEvent("onDbClick",block_readonly)
	//scheduler.attachEvent("onEventAdded", block_readonly)
	
	//Ativa no primeiro click
	//scheduler.attachEvent("onEventCreated", block_readonly)
	
	
	//scheduler.attachEvent("onEventAdded", function(id, e){
		//if(!id){
			//alert("teste");
			 //alert( this.getEvent(id).start_date );
		//}
			  
	    // -> {date:Tue Jun 30 2009 09:10:00, section:2}
	//})
	
	scheduler.attachEvent("onEventAdded", function(id,data){
        //alert("onAfterEventDisplay");
    });
	
	//impede a exclusão do evento
	//scheduler.attachEvent("onBeforeEventDelete",bloquearEvento)
	
	//impede a edição do evento
	//scheduler.attachEvent("onBeforeEventChanged",bloquearEvento)
	
	//impede a edição do evento
	
	function reuperaData( id, e ){
		var action_data = scheduler.getActionData(e);
		alert( scheduler.getEvent(id));
	}

	//variáveis da função
	// id - recupera o id da função
	// ev - recupera o evento (mouse, teclado, drag, etc)
	// data - recupera os dados
	function addEvento(){

		dhxWins = new dhtmlXWindows();
		
		//define a div que deve carrega a janela modal
		dhxWins.attachViewportTo("agenda");
		
		//define as propriedades da div
		w1 = dhxWins.createWindow("w1", 600, 300, 600, 400);
		//w1.setText("dhtmlxWindow #1");
		
		//define o tipo de janela como modal
		dhxWins.window("w1").setModal(true);

		//reuperar da data hora do evento
		w1.attachURL("<?php echo \core\url\Url::setURL("agenda","frm");?>", true, {data:"2015-10-15", horaInicial:"08:00"});
		
		return false;
	}

	
	
        //scheduler.load("./data/units.xml");

        <?php 
            foreach ($pAgenda->getAllArray() as $key => $agenda) {
                echo 'scheduler.addEvent({';
                echo "\n\t";
                echo 'id:'.$agenda["idAgenda"].',';
                echo "\n\t";
                echo 'start_date:"'.$agenda["data"].' '.$agenda["horaInicial"].'",';
                echo "\n\t";
                echo 'end_date:"'.$agenda["data"].' '.$agenda["horaFinal"].'",';
                echo "\n\t";
                echo 'text:"'.$agenda["titulo"].'",';
                echo "\n\t";
                echo 'section_id:"'.$agenda["sala"].'",';
                echo "\n\t";
                echo 'readonly:true';
                echo "\n";
                echo "});";
                echo "\n";
                
            }
		?>
		//scheduler.showLightbox("2");
}// init
</script>
		
</head>

<body onload="init();">

<div id="agenda" class="dhx_cal_container" style='width:100%; height:100%;'>
<div class="dhx_cal_navline">
<div class="dhx_cal_prev_button">&nbsp;</div>
<div class="dhx_cal_next_button">&nbsp;</div>
<div class="dhx_cal_today_button"></div>
<div class="dhx_cal_date"></div>
<div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
<div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
<div class="dhx_cal_tab" name="unit_tab" style="right:280px;"></div>
<div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
</div>
<div class="dhx_cal_header">
</div>
<div class="dhx_cal_data">
</div>
</div>

</body>

</html>