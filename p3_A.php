<?php

$fp = fopen("patata4.dat","w+");
$ft = fopen("patata4.txt","w+");


if ( $fp == false || $ft == false ) {

  echo "Error al crear el archivo</br>";

} else {

for($m=1;$m<=13080;$m++) {

//for ($k=1;$k<100;$k++) {
	
//   echo "Rojo - ";
   fwrite($fp,chr(254));
   fwrite($fp,chr(0));
   fwrite($fp,chr(0));
   
   fwrite($ft,"#FE0000|");    

	for ($i=1;$i<17;$i++) {
//		echo " Verde($i) - ";
	   	fwrite($fp,chr(0));
	   	fwrite($fp,chr(254));
   		fwrite($fp,chr(0));
   		
   		fwrite($ft,"#00FE00|");
   
  }

//   echo "Azul </br>"; 
   fwrite($fp,chr(0));
   fwrite($fp,chr(0));
   fwrite($fp,chr(254));
   
   fwrite($ft,"#0000FE|");    


//   echo "Blanco - ";
   fwrite($fp,chr(254));
   fwrite($fp,chr(254));
   fwrite($fp,chr(254));
   
   fwrite($ft,"#FFFFFF|");    

	for ($i=1;$i<20;$i++) {

//		echo " Negro($i) ";
		fwrite($fp,chr(0));
   		fwrite($fp,chr(0));
   		fwrite($fp,chr(0));
   		
   		fwrite($ft,"#000000|");
  }



//}

  echo "Iteracion " . $m . " realizada</br>";
  ob_flush();
  flush();

  
  fflush($fp);  
  fflush($ft);
   
  }
}

fclose($ft);
fclose($fp);

echo "</br>Se supone que ya está</br>";


?>
