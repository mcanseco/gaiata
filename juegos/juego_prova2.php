<?php

require_once("config.php");
require_once("apoyo.php");
require_once("mapeo.php");
require_once("componente.php");
require_once("gaiata.php");


$g = new gaiata();
$m = new mapeo("A02");



$lineas = array();
$brazos = array();

// Brazos
$actH = 0;
for ($i=0;$i<BRAZOS_NUM;$i++) {
	$lineas[$i] = new linea_mapeada();
	foreach ($tramos_brazos_fisico as $tr) {
		$lineas[$i]->trama($act,$tr[0],$tr[1]);
		$actH += $tr[0];
	}
	$id = $m->setlinea($lineas[$i]);
   $brazos[$i] = new brazo($id,"RGB");
	$actL = 0;	
	foreach ($tramos_brazos_logico as $tr) {
		$brazos[$i]->set_tramo(new tramo($actL,$tr))
		$actL += $tr;
	}
	$g->set_brazo($brazos[$i]);      	
}

// Picas
$actH = 0;
for ($i=0;$i<BRAZOS_NUM;$i++) {
	$lineas[$i] = new linea_mapeada();
	foreach ($tramos_brazos_fisico as $tr) {
		$lineas[$i]->trama($act,$tr[0],$tr[1]);
		$actH += $tr[0];
	}
	$id = $m->setlinea($lineas[$i]);
   $brazos[$i] = new brazo($id,"RGB");
	$actL = 0;	
	foreach ($tramos_brazos_logico as $tr) {
		$brazos[$i]->set_tramo(new tramo($actL,$tr))
		$actL += $tr;
	}
	$g->set_brazo($brazos[$i]);      	
}



$act = 0;
$l1 = new linea_mapeada();
$l1->trama($act,8,array());
$act += 8;
$l2 = new linea_mapeada();
$l2->trama(0,16,array());
$l3 = new linea_mapeada();
$l3->trama(0,8,array());
$l4 = new linea_mapeada();
$l4->trama(0,4,array());

$m = new mapeo("trlr3", 8, $elementos);
$m->setlinea($l1);
$m->setlinea($l2);
$m->setlinea($l3);
$m->setlinea($l4);


$b = new brazo($l1->id,"RGB");
$b->set_tramo(new tramo(0,8));
$a = new aro($l2->id,"RGB");
$a->set_tramo(new tramo(0,16));
$p = new pica($l3->id, "RBG");
$p->set_tramo(new tramo(0,8));
$ga = new gaiato($l4->id,"RGB");
$ga->set_tramo(new tramo(0,4));
 

$g = new gaiata();

$g->set_brazo($b);
$g->set_aro($a);
$g->set_pica($p);
$g->set_gaiato($ga);

$g->set_mapeo($m);



?>