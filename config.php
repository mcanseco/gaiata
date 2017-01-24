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
define('AROS_NUM',2);

$picas_fisico = array(array(36, array()), array(39, array()),array(42, array()),array(48, array()),array(48, array()),array(40, array(38,39)),array(32, array()),array(24, array()));
$picas_logico = array(36,39,42,48,48,38,32,24); 

$aros = array(40,80);

$tramos_brazos_fisico = array(array(20, array()), array(20, array()), array(20, array(19)), array(20, array(5,12,13)) , array(20, array(16,17,18,19)) );
$tramos_brazos_logico = array(20,20,19,17,16);
 
$gaiato = 15;


// Depuración

function deb($mensaje) {
  echo '<script>console.log("' . $mensaje .'")</script>';
  
}


?>