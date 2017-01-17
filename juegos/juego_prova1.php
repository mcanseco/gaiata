<?php

require_once("config.php");
require_once("apoyo.php");
require_once("mapeo.php");
require_once("componente.php");
require_once("gaiata.php");

// Elementos: BRAZOS / AROS / PICAS / GAIATO
$elementos = array(1,0,1,0);

// +++ Especificación Gaiata +++
$g = new gaiata();
// HW
$brazosHW = array();
$picasHW  = array();
$totalH = 0;
for ($i=0; $i<BRAZOS_NUM;$i++) {
  	$inicioA = 0;
  	$brazosHW[$i] = new linea_mapeada();
  	for ($k=0;$k<count($tramos_brazos_fisico);$k++) {
  		$brazosHW[$i]->trama($inicioA,$tramos_brazos_fisico[$k][0],$tramos_brazos_fisico[$k][1]);
  		$inicioA += $tramos_brazos_fisico[$k][0];
  		}
  	$totalH += $inicioA;	
	}
for ($i=0; $i<PICAS_NUM;$i++) {
  	$inicioA = 0;
  	$picasHW[$i] = new linea_mapeada();
  	for ($k=0;$k<count($picas);$k++) {
  		$picasHW[$i]->trama($inicioA,$picas[$k],array());
  		$inicioA += $picas[$k];
  		}
  	$totalH += $inicioA;	
	}
$m = new mapeo("juego_prova1",$totalH,$elementos);

for ($i=0; $i<BRAZOS_NUM;$i++) {
	$m->setlinea($brazosHW[$i]); 
   }
for ($i=0; $i<PICAS_NUM;$i++) {
	$m->setlinea($picasHW[$i]);
   }
$g->set_mapeo($m);

// LG
$brazosLG = array();
$picasLG = array();
for ($i=0; $i>BRAZOS_NUM;$i++) {
   $brazosLG[$i]	 = new brazo();
   $inicioA = 0;
   for ($k=0;$k<count($tramos_brazos_logico);$k++) {
   	$brazosLG[$i]->set_tramo(new tramo($inicioA,$tramos_brazos_logico[$k]));
   	$inicioA += $tramos_brazos_logico[$k];
   	}
   $g->set_brazo($brazosLG[$i]);
	}

for ($i=0; $i>PICAS_NUM;$i++) {
   $picasLG[$i]	 = new pica();
   $inicioA = 0;
   for ($k=0;$k<count($picas);$k++) {
   	$picasLG[$i]->set_tramo(new tramo($inicioA,$picas[$k]));
   	$inicioA += $pcias[$k];
   	}
   $g->set_pica($picasLG[$i]);
	}


?>