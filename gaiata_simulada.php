<?php

require_once("config.php");
require_once("apoyo.php");
require_once("mapeo.php");
require_once("componente.php");
require_once("gaiata.php");

class gaiata_simulada extends gaiata {

  public $SIMULACION = TRUE;
	
  function dibuja_brazos() {
  	for ($i=0;$i<BRAZOS_NUM;$i++)    
    foreach ($this->brazos as $br) {
    	$z = -1;	
		$inicios = $br->get_inicios_tramos();
		//print_r($inicios);
		$actual = array_shift($inicios);
		for ($j=0;$j<$br->get_tamanyo();$j++) {
			if ($actual==$j) {$z++; $actual = array_shift($inicios); }
			$x = (950 + $i*50);
			$y = (570-($j+$z)*5);
			$dato = $this->mapeo->lineas[$br->linea_asociada]->A[$j];
		 	echo "ctx.beginPath(); \n";
			echo "ctx.arc($x,$y,2,0,2*Math.PI); \n";
			echo "ctx.fillStyle = datos[$dato]; \n";
			echo "ctx.fill(); \n";
			echo "ctx.closePath(); \n \n";
		}    
    }
  }
	  	
  function dibuja_aros() {
   $desplazaX = 750;
   $desplazaY = 400;
  	$inc = 20;
  	$radio = 130;
   foreach ($this->aros as $aro) {
		$inicios = $aro->get_inicios_tramos();
		$numero_aros = count($aro->get_inicios_tramos());
		$tamanyo = $aro->get_tamanyo() / $numero_aros;	
   	$angulo = 360 / $tamanyo;
   	for($k=0;$k<$numero_aros;$k++) {
		  for ($j=0;$j<$tamanyo;$j++) {
			  $x = ($radio*cos(deg2rad($angulo*$j+100)) + $desplazaX)+10;
			  $y = ($radio*sin(deg2rad($angulo*$j+100)) + $desplazaY)+10;
 			  $dato = $this->mapeo->lineas[$aro->linea_asociada]->A[($j+$tamanyo*$k)];
 
			  echo "ctx.beginPath(); \n";
			  echo "ctx.arc( $x , $y ,5,0,2*Math.PI); \n";
			  echo "ctx.fillStyle = datos[$dato]; \n";
			  echo "ctx.fill(); \n";
			  echo "ctx.closePath(); \n \n";
			
		  }
		  $radio-=10;
		 } 
		 $radio-=$inc;   
      }
   }


  function dibuja_picas() { 
   $desplaza = 275;
   $inc = 30;
   $radio = 275;
   foreach ($this->picas as $pica) {
		$tamanyo = $pica->get_tamanyo();
   	$angulo = 360 / $tamanyo;
	   for ($j=0;$j<$tamanyo;$j++) {
			  $x = ($radio*cos(deg2rad($angulo*$j+100)) + $desplaza)+10;
			  $y = ($radio*sin(deg2rad($angulo*$j+100)) + $desplaza)+10;
 			  $dato = $this->mapeo->lineas[$pica->linea_asociada]->A[$j];
 
			  echo "ctx.beginPath(); \n";
			  echo "ctx.arc( $x , $y ,5,0,2*Math.PI); \n";
			  echo "ctx.fillStyle = datos[$dato]; \n";
			  echo "ctx.fill(); \n";
			  echo "ctx.closePath(); \n \n";
			
		 } 
		 $radio-=$inc;   
      }
   }

  function dibuja_gaiato() {
 	  
 	  for ($j=0;$j<$this->gaiato[0]->get_tamanyo();$j++) {	
			$x = (1200 + $i*50);
			$y = (95-($j)*5);
			$dato = $this->mapeo->lineas[$this->gaiato[0]->linea_asociada]->A[$j];
		 	echo "ctx.beginPath(); \n";
			echo "ctx.arc($x,$y,2,0,2*Math.PI); \n";
			echo "ctx.fillStyle = datos[$dato]; \n";
			echo "ctx.fill(); \n";
			echo "ctx.closePath(); \n \n";
		}    
    
  }


  	
	
	
	
}

?>