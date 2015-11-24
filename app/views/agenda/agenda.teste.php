<!doctype html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<title>Agenda HUAB</title>

<script src="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/dhtmlxscheduler.js" type="text/javascript" charset="utf-8"></script>
<script src="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/ext/dhtmlxscheduler_units.js" type="text/javascript" charset="utf-8"></script>

<link rel="stylesheet" href="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/dhtmlxscheduler.css" type="text/css" title="no title">

<!-- usar fragmento na URL http://localhost/huab/agenda/teste#date=2014-01-30,mode=month -->
<script src="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/ext/dhtmlxscheduler_url.js" type="text/javascript" charset="utf-8"></script>

<!-- eventos para apenas leitura -->
<script src="<?=BASEURL?>/public/lib/dhtmlxScheduler_v4.3.1/codebase/ext/dhtmlxscheduler_readonly.js" type="text/javascript" charset="utf-8"></script>

<style type="text/css" media="screen">
html, body{
    margin:0px;
    padding:0px;
    height:100%;
    overflow:hidden;
}
</style>

<script type="text/javascript" charset="utf-8">
function init() {

    var sections=[
    {key:1, label:"VC01 - GEP"},
    {key:2, label:"VC02 - Sala Video"},
    {key:3, label:"Auditório"},
    {key:4, label:"VC03 - Superintendência"}
    ];

    scheduler.locale.labels.unit_tab = "Unit"
        scheduler.locale.labels.section_custom="Section";
    scheduler.config.details_on_create=false;
    scheduler.config.details_on_dblclick=false;
    scheduler.config.xml_date="%Y-%m-%d %H:%i";

    scheduler.config.lightbox.sections=[
    {name:"description", height:130, map_to:"text", type:"textarea" , focus:true},
    {name:"custom", height:23, type:"select", options:sections, map_to:"section_id" },
    {name:"time", height:72, type:"time", map_to:"auto"}
    ]

    scheduler.createUnitsView({
        name:"unit",
        property:"section_id",
        list:sections
    });
    scheduler.config.multi_day = true;

    scheduler.init('scheduler_here',new Date(2014,5,30),"unit");
    //scheduler.load("./data/units.xml");
}
</script>
</head>


<body onload="init();">

<div id="scheduler_here" class="dhx_cal_container" style='width:100%; height:100%;'>
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