<?php

require_once("config.php");
require_once("apoyo.php");
require_once("mapeo.php");
require_once("componente.php");
require_once("gaiata.php");

// Elementos: BRAZOS / AROS / PICAS / GAIATO
$elementos = array(1,1,1,1);

$l1 = new linea_mapeada();
$l1->trama(0,8,array());
//$l2 = new linea_mapeada();
//$l2->trama(16,array());
$l3 = new linea_mapeada();
$l3->trama(8,8,array());
$l4 = new linea_mapeada();
$l4->trama(16,4,array());

$m = new mapeo("trlr4");
$m->setlinea($l1);
//$m->setlinea($l2);
$m->setlinea($l3);
$m->setlinea($l4);


$b = new brazo($l1->id,"RGB");
$b->set_tramo(new tramo(0,8));
//$a = new aro($l2->id,"RGB");
//$a->set_tramo(new tramo(0,16));
$p = new pica($l3->id, "RBG");
$p->set_tramo(new tramo(0,8));
$ga = new gaiato($l4->id,"RGB");
$ga->set_tramo(new tramo(0,4));
 

$g = new gaiata();

$g->set_brazo($b);
//$g->set_aro($a);
$g->set_pica($p);
$g->set_gaiato($ga);

$g->set_mapeo($m);

echo "College</br>";

// $una  = $g->brazos[0]->intercala_colores(array("#AAAAAA","#BBBBBB","#CCCCCC"), 0.25, 1, false, 1, 0, -1, $g->mapeo);
// echo $una . "</br>";
 //$dos  = $g->brazos[0]->intercala_colores(array("#AAAAAA","#BBBBBB","#CCCCCC"), 0.25, 1, false, 1, 0, -1, $g->mapeo);
 //echo $dos . "</br>";
 
 $tres = $g->brazos[0]->tira_sube("#00FF00", 1, true, 1, -1, -1, $g->mapeo);
 echo $tres . "</br>";
 //$tres = $g->picas[0]->tira_sube("#00FF00", 1, true, 2, -1, -1, $g->mapeo);
 //echo $tres . "</br>";

/*
 $tres = $g->aros[0]->tira_sube("#00FF00", 1, false, 1, -1, -1, $g->mapeo);
 echo $tres . "</br>";
 $tres = $g->aros[0]->tira_sube("#00FF00", 1, false, 2, -1, -1, $g->mapeo);
 echo $tres . "</br>";
*/


 $tres = $g->gaiato->tira_sube("#FFFFFF", 1, true, 1, -1, -1, $g->mapeo);
 echo $tres . "</br>";
// $tres = $g->gaiato->tira_sube("#00FF00", 1, false, 2, -1, -1, $g->mapeo);
// echo $tres . "</br>";


$g->mapeo->almacena();



?>