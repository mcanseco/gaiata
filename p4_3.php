<?php

require_once("config.php");
require_once("mapeo.php");
require_once("gaiata.php");

// Elementos: BRAZOS / AROS / PICAS / GAIATO
$elementos = array(1,0,0,0);

/*
echo "RGB2CHR = " . rgb2chr("#414141") . "</br>";
echo "rgb_bytes2txt($r,$g,$b)= " . rgb_bytes2txt(65,254,253) . "</br>";
echo "rgb_txt2bytes($rgb)= " . var_dump(rgb_txt2bytes("#FFEEFF")) . "</br>";
echo "rgb2hsv($rgb)= " . var_dump(rgb2hsv("#A05E5E")) . "</br>";
echo "hsv2rgb(HSV)= " . hsv2rgb(array("H" => 0, "S" => 0.4125, "V" => 0.62745098039216)) . "</br>";

echo "</br>";

echo "Degradado = " . var_dump(degradado_de_a("#FF0000", "#0000FF", 4)) . "</br>"; 

echo "Degradado Aclara/Oscurece </br>";
echo var_dump(degradado_ao("#333333",5,80,true));


*/

$l = new linea_mapeada();

$m = new mapeo("trlr3", 16, $elementos);

$l->trama(0,16,array());

$m->setlinea($l);

//$m->muestra_A(0);


$t0 = new tramo(0,8);
$t1 = new tramo(8,8);

$b  = new brazo();
$b->set_tramo($t0);
$b->set_tramo($t1);

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


 $una  = $g->brazos[0]->intercala_colores(array("#AAAAAA","#BBBBBB","#CCCCCC"), 0.25, 1, false, 1, 0, -1, $g->mapeo);
 echo $una . "</br>";
 $dos  = $g->brazos[0]->intercala_colores(array("#AAAAAA","#BBBBBB","#CCCCCC"), 0.25, 1, false, 1, 0, -1, $g->mapeo);
 echo $dos . "</br>";
 $tres = $g->brazos[0]->tira_sube_sola("#FFFFFF", 1, true, 1, 0, $una, $g->mapeo);
 echo $tres . "</br>";;
//$g->brazos[0]->tira_sube("#FF0000",1, false, 1, 1, $g->mapeo);
//$g->brazos[0]->rellena_color("#00FF00",1,$g->mapeo);
//$g->brazos[0]->tira_degrada_de_a("#FF0000","#0000FF",3,1,$g->mapeo);

//$g->brazos[0]->tira_degrada_ao("#333333",5,100,false,1,$g->mapeo);

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
