<?php

require_once("../config.php");
require_once("../apoyo.php");
require_once("../mapeo.php");
require_once("../componente.php");
require_once("../gaiata.php");

$colores = array("#FF0000",COLOR_VERDE_BASE,COLOR_VERDE_MAS_CLARO,COLOR_VERDE_OSCURO,COLOR_CLARO);

$tiempo = 20;

//$g = new gaiata(array($tramos_brazos_fisico,$aros_fisico,$picas_fisico,$gaiato),array($tramos_brazos_logico,$aros_logico,$picas_logico),"a7");

$g = new gaiata(array($tramos_brazos_fisico,$aros_fisico,$picas_fisico,$gaiato),array($tramos_brazos_logico,$aros_logico,$picas_logico),"a0");

$gaiato_direccion = true;


	for ($i=0;$i<PICAS_NUM;$i++) {
		$g->picas[$i]->rellena_color($colores[0], $tiempo, -1, -1, $g->mapeo);
	//	debOK("i = $i /  ");
		}

	for ($i=0;$i<BRAZOS_NUM;$i++) 
		for ($j=0;$j<count($tramos_brazos_logico);$j++) {	
			$g->brazos[$i]->rellena_color($colores[0], $tiempo, -1, -1, $g->mapeo); 
//	 		$g->brazos[$i]->tira_sube($colores[(($k+$j) % 2)], $tiempo, false, 1, $j, $temporal, $g->mapeo);
	 		}

	$g->aros[0]->rellena_color($colores[0], $tiempo, -1, -1, $g->mapeo);
	$g->aros[1]->rellena_color($colores[0], $tiempo, -1, -1, $g->mapeo);
//	$g->aros[1]->tira_sube_sola($colores[2], $tiempo, false, 1, -1, $temporal, $g->mapeo);
	

// 	$temporal = $g->gaiato[0]->rellena_color($colores[0], $tiempo, -1, -1, $g->mapeo);
	$g->gaiato[0]->rellena_color($colores[0], $tiempo, -1, -1, $g->mapeo);
	
	//$gaiato_direccion = !$gaiato_direccion;



echo "Definida </br>";

$g->mapeo->almacena();

?>