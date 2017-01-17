<?php

require_once("config.php");
require_once("mapeo.php");
require_once("gaiata.php");

// Elementos: BRAZOS / AROS / PICAS / GAIATO
$elementos = array(1,0,0,0);



$total = 0;
for ($i=0;$i<count($picas);$i++)
	$total += $picas[$i];
for ($i=0;$i<count($tramos_brazos_fisico);$i++)
	$total += $tramos_brazos_fisico[$i][0];
for ($i=0;$i<count($aros);$i++)
	$total += $aros[$i];
$total += $gaiato;



$l = new linea_mapeada();

$m = new mapeo("A0", $total, $elementos);

$l->trama(0,$total,array());

$m->setlinea($l);

//$m->muestra_A(0);


$t0 = new tramo(0,$total);
//$t1 = new tramo(8,8);

$b  = new brazo();
$b->set_tramo($t0);
//$b->set_tramo($t1);

$g = new gaiata();

$g->set_brazo($b);

$g->set_mapeo($m);

/*
$g->brazos[0]->tira_sube_sola_tramo("#00FF00", 0.5, true, 1, -1 , $g->mapeo);
$g->brazos[0]->tira_sube_sola_tramo("#FFFFFF", 2, true, 1, 0 , $g->mapeo);
$g->brazos[0]->tira_sube_sola_tramo("#FF0000", 1, true, 1, 1 , $g->mapeo);
$g->brazos[0]->tira_sube_sola_tramo("#FF0000", 1, true, 1, 1 , $g->mapeo);
$g->brazos[0]->tira_sube_sola_tramo("#FF0000", 1, true, 1, 1 , $g->mapeo);
*/


 $una  = $g->brazos[0]->intercala_colores(array("#AAAAAA","#BBBBBB","#CCCCCC"), 1, 10, true, 1, -1, -1, $g->mapeo);
 echo $una . "</br>";
 $dos  = $g->brazos[0]->tira_degrada_de_a("#FF0000","#0000FF",5, 5, -1, -1, $g->mapeo);
 echo $dos . "</br>";

 
/* 
 echo $una . "</br>";
 $dos  = $g->brazos[0]->intercala_colores(array("#AAAAAA","#BBBBBB","#CCCCCC"), 0.25, 1, false, 1, 0, -1, $g->mapeo);
 echo $dos . "</br>";
 $tres = $g->brazos[0]->tira_sube_sola("#FFFFFF", 1, true, 1, 0, $una, $g->mapeo);
 echo $tres . "</br>";;
//$g->brazos[0]->tira_sube("#FF0000",1, false, 1, 1, $g->mapeo);
//$g->brazos[0]->rellena_color("#00FF00",1,$g->mapeo);
//$g->brazos[0]->tira_degrada_de_a("#FF0000","#0000FF",3,1,$g->mapeo);

//$g->brazos[0]->tira_degrada_ao("#333333",5,100,false,1,$g->mapeo);

*/

$g->mapeo->almacena();



/*

$LED = array ( array(0,0,"#FF0000"), array(0,1,"#FF0000"), array(0,2,"#FF0000"), array(0,4,"#00FF00"), array(1,0,"#0000FF"), array(1,1,"#FF0000"), array(1,2,"#FF0000"), array(1,4,"#00FF00") );

$m->mapea_linea(0,0,3,0,$LED);

$m->almacena();




/*

$a = array();

$a[0] = "Uno";

echo $a[0];

$a[1] = chr(65) . chr(13) . chr(65);

echo $a[1];

$a[2] = array('uno' , 1 );

echo $a[2][0];

echo $a[2][1];

*/

?>
