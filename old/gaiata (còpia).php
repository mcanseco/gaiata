<?php

class tramo {

  public $id;
  private $inicio;
  private $tamanyo;
    
  function __construct($inicio, $tamanyo) {
    $this->inicio = $inicio;
    $this->tamanyo = $tamanyo;
  }

  function get_tamanyo() {
    return $this->tamanyo;
  }

// F: TIRA_SUBE - arriba = true / abajo = false
  function tira_sube($color, $tiempo, $arriba) {
    $leds      = array();
    $ciclos    = $tiempo * FPS;
    $num_ciclo = ($this->tamanyo) / $ciclos;
    deb($this->tamanyo);    
    if ($arriba) {
      for ($i=0;$i<$ciclos;$i++) {
        $num = ($i+1)*$num_ciclo;
        for ($j=0; $j<$num;$j++) {
          array_push($leds, array($i,$j,$color));
          deb("i = " . ($i) . " j = " . $j . " num = " . $num . " num real = " . $i*$num_ciclo );
        }
      }
    } 
    else { 
      for ($i=0;$i<$ciclos;$i++) {
        $num = (($this->tamanyo-1)-$num_ciclo*($i+1));
        for ($j=($this->tamanyo-1); $j>$num;$j--) {
          array_push($leds, array($i,$j,$color));
          deb("i = " . ($i) . " j = " . $j . " num = " . $num);
          }
        }
    }
    return $leds;
  }
  
  

} // Fin de la clase Tramo


class brazo {
  
  public   $tramos = array();
  private  $tramos_cuenta = 0;
  private  $ciclo = 0;
  public  $id;
  private  $tamanyo = 0;


  function set_tramo(tramo $tramo) {
    $tramos->id = $this->tramos_cuenta++;
    $this->tamanyo += $tramo->get_tamanyo();
    array_push($this->tramos, $tramo);
  }
    
// F: rellena_color
  function rellena_color($color, $tiempo, mapeo $m) {
    $leds = array();
    $ciclos = ( FPS * $tiempo );
    for ($i=0;$i<$ciclos;$i++)
     for ($j=0;$j<$this->tamanyo;$j++)
       array_push($leds, array($i,$j,$color) );
    $m->mapea_linea($this->id,$this->ciclo,$ciclos,0,$leds);
    $this->ciclo += $ciclos;
  }

// F: TIRA_DEGRADA_DE_A
  function tira_degrada_de_a($colorDE,$colorA,$iteraciones, $tiempo ,mapeo $m) {
  	$leds = array();  	
  	$ciclos = (FPS * $tiempo);
  	$intermedios = degradado_de_a($colorDE,$colorA,$iteraciones);
   $paso = $ciclos / $iteraciones;
   $ini = 0;
  	for($k=1;$k<=$iteraciones;$k++)  	  
  	  for($i=$ini;$i<($paso*$k);$i++, $ini++)
  	    for($j=0;$j<$this->tamanyo;$j++) 
  	      array_push($leds, array($i,$j,$intermedios[$k]));
   $m->mapea_linea($this->id,$this->ciclo,$ciclos,0,$leds);
  	$this->ciclo += $ciclos; 
}

// F: TIRA_DEGRADA_AO
  function tira_degrada_ao($color,$iteraciones, $porcentaje, $aclara_obscurece, $tiempo, mapeo $m) {
  	$leds = array();  	
  	$ciclos = (FPS * $tiempo);
  	$intermedios = degradado_ao($color, $iteraciones, $porcentaje, $aclara_obscurece);
   $paso = $ciclos / $iteraciones;
   $ini = 0;  	
  	for($k=1;$k<=$iteraciones;$k++)   	  
  	  for($i=$ini;$i<($paso*$k);$i++, $ini++) 
  	    for($j=0;$j<$this->tamanyo;$j++) 
  	      array_push($leds, array($i,$j,$intermedios[$k]));
   $m->mapea_linea($this->id,$this->ciclo,$ciclos,0,$leds);
  	$this->ciclo += $ciclos; 
}
 
// F: TIRA_SUBE  
  function tira_sube($color, $tiempo, $paso, $arriba, mapeo $m) {
    $leds      = array();
    $ciclos = ( FPS * $tiempo );
    $cini   = $this->ciclo;
    $this->ciclos += $ciclos;
    $num_ciclo = ($this->tamanyo) / $ciclos;
    deb($this->tamanyo);    
    if ($arriba) {
      for ($i=0;$i<$ciclos;$i++) {
        $num = ($i+1)*$num_ciclo;
        for ($j=0; $j<$num;$j++) {
          array_push($leds, array($i,$j,$color));
          deb("i = " . ($i) . " j = " . $j . " num = " . $num . " num real = " . $i*$num_ciclo );
        }
      }
    } 
    else { 
      for ($i=0;$i<$ciclos;$i++) {
        $num = (($this->tamanyo-1)-$num_ciclo*($i+1));
        for ($j=($this->tamanyo-1); $j>$num;$j--) {
          array_push($leds, array($i,$j,$color));
          deb("i = " . ($i) . " j = " . $j . " num = " . $num);
          }
        }
    }

//    deb(var_dump($leds));
    deb("Empiezooo...");
    deb("Id " . $this->id . " / Cini " . $cini . " / Ciclos " . $ciclos. " / Tini = 0");
    $m->mapea_linea($this->id,$cini,$ciclos,0,$leds);
  }

// F: TIRA_SUBE_SOLA -- NO TOCAR
  function tira_sube_sola2($color, $tiempo, $arriba, $paso , mapeo $m) {
    $leds      = array();
    $ciclos = ( FPS * $tiempo );
    $this->ciclos += $ciclos;
    $num_ciclo = ($this->tamanyo-($paso-1)) / $ciclos;
    if ($arriba) {
    	$ini = 0;
      for ($i=0;$i<$ciclos;$i++) {
        $num = ($i+1)*$num_ciclo;
        for ($j=($num > $ini ? $ini : $jA); $j<$num; $j++, $ini++) {
			 for($jj=0;$jj<$paso;$jj++) {         
            array_push($leds, array($i,($j+$jj),$color));
            deb("i = " . $i . " j = " . ($j+$jj) . " num = " . $num . " num real = " . $i*$num_ciclo );			 }          
          $jA = $j; 
        }
      }
    } 
    else {
    	$ini = $this->tamanyo - 1; 
      for ($i=0;$i<$ciclos;$i++) {
        $num = (($this->tamanyo-1)-$num_ciclo*($i+1));
        for ($j=($num < $ini ? $ini : $jA); $j>$num;$j--, $ini--) {
			 for($jj=0;$jj<$paso;$jj++) {        	
            array_push($leds, array($i,($j-$jj),$color));
            deb("i = " . ($i) . " j = " . ($j-$jj) . " num = " . $num);
          }
          $jA = $j;
        }
        }
    }
    $m->mapea_linea($this->id,$cini,$ciclos,0,$leds);
  }


// F: TIRA_SUBE_SOLA  
  function tira_sube_sola($color, $tiempo, $arriba, $paso , mapeo $m) {
    $leds      = array();
    $ciclos = ( FPS * $tiempo );
    $this->ciclos += $ciclos;
    $num_ciclo = ($this->tamanyo) / $ciclos;
    if ($arriba) {
    	$ini = 0;
      for ($i=0;$i<$ciclos;$i+=$paso) {
        $num = ($i+$paso)*$num_ciclo;
        for ($j=($num > $ini ? $ini : $jA); $j<$num; $j++, $ini++) {
        	 for ($ii=0;$ii<$paso;$ii++) { 
            array_push($leds, array(($i+$ii),$j,$color));
            deb("i = " . ($i+$ii). " j = " . $j . " num = " . $num . " num real = " . $i*$num_ciclo );			 
            }
          }          
          $jA = $j; 
        }
    } 
    else {
    	$ini = $this->tamanyo - 1; 
      for ($i=0;$i<$ciclos;$i+=$paso) {
        $num = (($this->tamanyo-1)-$num_ciclo*($i+$paso));
        for ($j=($num < $ini ? $ini : $jA); $j>$num;$j--, $ini--) {
			 for($ii=0;$ii<$paso;$ii++) {        	
            array_push($leds, array($i+$ii,$j,$color));
            deb("i = " . ($i+$ii) . " j = " . $j . " num = " . $num);
          }
          $jA = $j;
        }
        }
    }
   
    $m->mapea_linea($this->id,$cini,$ciclos,0,$leds);
  }




/*
// F: TIRA_SUBE_BRILLANTEº
  function tira_sube_brillante($colorbrillante, $nuevocolor, $arriba, $continua, $tiempo, mapeo $m) {
  	
  	
  	}
*/

} // Fin de la clase brazo

class gaiata {

  // Elementos de la Gaiata
  public $brazos = array();
  private $brazos_cuenta = 0;
  // Conexionado
  public $mapeo;
  
  function set_brazo(brazo $brazo) {
    $brazo->id = $this->brazos_cuenta++;
    array_push($this->brazos, $brazo);
  }

  function set_mapeo(mapeo $mapeo) {
    $this->mapeo = $mapeo;
  }  

}


?>
