<?php


// Configuración
$ciclos = 100;
$leds   = 909;
$color  = "#FF0000";
$colorN = "#000000";
$fps    = -1;
$bn		  = true;
$en_negro = false;


function rgb2chr($rgb) {
  $r = hexdec(substr($rgb,1,2));
  $g = hexdec(substr($rgb,3,2));
  $b = hexdec(substr($rgb,5,2));
  return(chr($r) . chr($g) . chr($b) );
}


// Comienza el programa

$fp = fopen("a4.dat","w+");
$ft = fopen("a4.txt","w+");
//$fr = fopen("patata4.rpi","w+");

//if ( $fp == false || $ft == false || $fr == false  ) {
if ( $fp == false || $ft == false ) {

  echo "Error al crear el archivo</br>";

} else {

echo "</br>Empiezo</br>";

if ($fps>0) fwrite($fp, chr($fps));

for($m=0;$m<$ciclos;$m++) {
		if ($bn && $en_negro) {
			for ($k=0;$k<$leds;$k++) {
	   		fwrite($fp,rgb2chr($colorN));
   			fwrite($ft,$colorN . "|");
   		}
   		$en_negro = false;      	
		} else {
			for ($k=0;$k<$leds;$k++) {	
				fwrite($fp,rgb2chr($color));
   			fwrite($ft,$color . "|");
   		}
			$en_negro = true;
		}

   	ob_flush();
      flush();
  }
  fflush($fp);  
  fflush($ft);

fclose($ft);
fclose($fp);

echo "</br>Se supone que ya está</br>";
}

?>
