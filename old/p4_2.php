<?php

include "mapeo.php";


echo "Empiezo </br> \n";

$m = new mapeo();

$l = new linea_mapeada(10);

$l->trama(2,8,array (3,5));

//$l->muestra_A();

$m->setlinea($l);

$m->muestra_A(0);
//$m->lista_lineas();


/*
for ($i=0;$i<10;$i++) {
  $l = new linea_mapeada($i);
  $m->setlinea($l);
 
}

echo "Lista de mapeos </br> \n";

 $m->lista_lineas();

echo "Aleatorios </br> \n";

 $m->devuelve_linea(3);
 $m->devuelve_linea(2);
 
*/
echo "Fin de la prueba </br> \n";
?>
