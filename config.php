<?php

/* *** Constantes *** */


// Velocidad

define('FPS', 8);
//define('', );

// Colores

define('COLOR_BASE','#000000');
define('COLOR_VERDE_CLARO','#00FF43');
define('COLOR_VERDE_FUERTE','#11E80C');
define('COLOR_VERDE_BASE','#67FF0D');

// Especificaciones de la GAIATA

define('BRAZOS_NUM',4);
define('PICAS_NUM', 8);
define('PICAS_BAJO_NUM', 5);
define('PICAS_ALTO_NUM', 3);
define('AROS_NUM',2)

$picas = array(36,39,42,40,40,38,32,24); 

$aros = array(80,40);

$tramos_brazos_fisico = array(array(20, array()), array(20, array()), array(20, array(19)), array(20, array(5,12,13)) , array(20, array(16,17,18,19)) );
$tramos_brazos_logico = array(20,20,19,17,16);
 
$gaiato = 15;


// Depuración

function deb($mensaje) {
  echo '<script>console.log("' . $mensaje .'")</script>';
  
}


?>