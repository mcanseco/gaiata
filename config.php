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

define('BRAZOS_NUM',1); 
define('PICAS_NUM', 8);
define('PICAS_BAJO_NUM', 5);
define('PICAS_ALTO_NUM', 3);
define('AROS_NUM',2);

$tramos_brazos_fisico = array("RGB",array(array(20, array()), array(20, array()), array(20, array(19)), array(20, array(5,12,13)) , array(20, array(16,17,18,19))));
$tramos_brazos_logico = array(array(0,20),array(20,20),array(40,19),array(59,17),array(76,16));

$aros_fisico = array("RGB", array(array(40, array()),array(80, array())));
$aros_logico = array(1,2); 
 
$picas_fisico = array("RBG", array(array(36, array()), array(39, array()),array(42, array()),array(48, array()),array(48, array()),array(40, array(38,39)),array(32, array()),array(24, array())));
$picas_logico = array(4,4,4,4,4,4,4,4);

$gaiato = array("RGB",array(array(20, array(15,16,17,18,19))));


// Depuración

function deb($mensaje) {
  echo '<script>console.log("' . $mensaje .'")</script>';
  
}


?>