<?php

$fp = fopen("patata3.dat","w+");

if ( $fp == false ) {

  echo "Error al crear el archivo</br>";

} else {



for ($k=1;$k<100;$k++) {
	
	echo "Rojo - ";
   fwrite($fp,chr(254));
   fwrite($fp,chr(0));
   fwrite($fp,chr(0));    

	for ($i=1;$i<19;$i++) {
		echo " Verde($i) - ";
	   fwrite($fp,chr(0));
   	fwrite($fp,chr(254));
   	fwrite($fp,chr(0));
   
  }

	echo "Azul </br>"; 
   fwrite($fp,chr(0));
   fwrite($fp,chr(0));
   fwrite($fp,chr(254));    


   echo "Blanco - ";
   fwrite($fp,chr(254));
   fwrite($fp,chr(254));
   fwrite($fp,chr(254));    

	for ($i=1;$i<20;$i++) {

		echo " Negro($i	) ";
	   fwrite($fp,chr(0));
   	fwrite($fp,chr(0));
   	fwrite($fp,chr(0));
   
  }

	echo "</br>";
}

  
  fflush($fp);  
  
  }
  
fclose($fp);

?>
