<?php
require_once("config.php");
require_once("apoyo.php");
require_once("mapeo.php");

class tramo {

  public  $id;
  public  $inicio;
  public  $tamanyo;
  public  $ciclo = 0;
    
  function __construct($inicio, $tamanyo) {
    $this->inicio = $inicio;
    $this->tamanyo = $tamanyo;
  }

  function get_tamanyo() {
    return $this->tamanyo;
  }

  function set_ciclo($c) {
     $this->ciclo = $c;
   }

  function get_ciclo() {
    return $this->ciclo;  	
   }

} // Fin de la clase Tramo


class componente {
  
  public   $tramos = array();
  private  $tramos_cuenta = 0;
  private  $ciclo = 0;
  public   $id;
  private  $tamanyo = 0;
  private	$tr = 0;
  private  $esquema_de_color;
  private	$linea_asociada;

  function __construct($linea, $esquema) {
    $this->linea_asociada = $linea;
    $this->esquema_de_color = $esquema;
  }

  function set_tramo(tramo $tramo) {
    $tramos->id = $this->tramos_cuenta++;
    $this->tamanyo += $tramo->get_tamanyo();
    array_push($this->tramos, $tramo);
  }
  
  function upd_tramo($id, $ciclosINC) {
     $trr = ($this->tramos[$id]->ciclo + $ciclosINC);
     if ( $trr > $this->tr )  {
         $this->ciclo += $trr - $this->tr; 			
         $this->tr = $trr;			
         $cini = ($this->ciclo-($trr-$this->tramos[$id]->ciclo));
         deb("Tramo ciclo: " . $trr);
         deb("Antes Id (" . $id . " ) - " . $this->tramos[$id]->ciclo);
         $this->tramos[$id]->set_ciclo($trr);
         deb("Después Id (" . $id . " ) - " . $this->tramos[$id]->get_ciclo());
         return $cini;
      }
     else {
         $cini = ($this->ciclo- ($this->tr - $this->tramos[$id]->ciclo));
         $this->tramos[$id]->ciclo = $trr;
         return $cini;
      }
   }

  // Actualiza el color segun su estado
  function ce($color) {
		if ($this->esquema_de_color=="RBG")
				return substr($color,0,3) . substr($color,5,2) . substr($color,3,2);
	   else
				return $color;
  	}
    
// F: rellena_color
  function rellena_color($color, $tiempo, $tramo, $ci, mapeo $m) {
    $leds = array();
    $ciclos = ( FPS * $tiempo );
    if ($tramo<0) {
		 if ($ci<0) {      
         $cini = $this->ciclo;
         $this->ciclo += $ciclos;
       } else $cini = $ci;
       $tamanyo = $this->tamanyo;
       $tramoPos = 0;		    	
    } else {
       $cini = ( $ci<0 ? $this->upd_tramo($tramo, $ciclos) : $ci );
       $tamanyo = $this->tramos[$tramo]->tamanyo;
       $tramoPos = $this->tramos[$tramo]->inicio;
    };

    for ($i=0;$i<$ciclos;$i++)
     for ($j=0;$j<$tamanyo;$j++)
       array_push($leds, array($i,$j,$color) );
    $m->mapea_linea($this->id,$cini,$ciclos,$tramoPos,$leds);
    return $cini;
  }

// F: TIRA_DEGRADA_DE_A
  function tira_degrada_de_a($colorDE,$colorA,$iteraciones, $tiempo, $tramo, $ci, mapeo $m) {
   $leds = array();  	
   $ciclos = (FPS * $tiempo);
    if ($tramo<0) {
		 if ($ci<0) {      
         $cini = $this->ciclo;
         $this->ciclo += $ciclos;
       } else $cini = $ci;
       $tamanyo = $this->tamanyo;
       $tramoPos = 0;		    	
    } else {
       $cini = ( $ci<0 ? $this->upd_tramo($tramo, $ciclos) : $ci );
       $tamanyo = $this->tramos[$tramo]->tamanyo;
       $tramoPos = $this->tramos[$tramo]->inicio;
    };
   
   $intermedios = degradado_de_a($colorDE,$colorA,$iteraciones);
   $paso = $ciclos / $iteraciones;
   $ini = 0;
   for($k=1;$k<=$iteraciones;$k++)  	  
     for($i=$ini;$i<($paso*$k);$i++, $ini++)
       for($j=0;$j<$tamanyo;$j++) 
         array_push($leds, array($i,$j,$this->ce($intermedios[$k])));
   $m->mapea_linea($this->linea_asociada,$cini,$ciclos,$tramoPos,$leds);
   return $cini; 
}

// F: TIRA_DEGRADA_AO
  function tira_degrada_ao($color,$iteraciones, $porcentaje, $aclara_obscurece, $tiempo, $tramo, $ci, mapeo $m) {
   $leds = array();  	
   $ciclos = (FPS * $tiempo);
    if ($tramo<0) {
		 if ($ci<0) {      
         $cini = $this->ciclo;
         $this->ciclo += $ciclos;
       } else $cini = $ci;
       $tamanyo = $this->tamanyo;
       $tramoPos = 0;		    	
    } else {
       $cini = ( $ci<0 ? $this->upd_tramo($tramo, $ciclos) : $ci );
       $tamanyo = $this->tramos[$tramo]->tamanyo;
       $tramoPos = $this->tramos[$tramo]->inicio;
    };
   
   $intermedios = degradado_ao($color, $iteraciones, $porcentaje, $aclara_obscurece);
   $paso = $ciclos / $iteraciones;
   $ini = 0;  	
   for($k=1;$k<=$iteraciones;$k++)   	  
     for($i=$ini;$i<($paso*$k);$i++, $ini++) 
       for($j=0;$j<$tamanyo;$j++) 
         array_push($leds, array($i,$j,$this->ce($intermedios[$k])));
   $m->mapea_linea($this->linea_asociada,$cini,$ciclos,$tramoPos,$leds);
   return $cini;
}

// F: INTERCALA_COLORES
  function intercala_colores($colores, $tiempo_color, $tiempo, $arriba, $paso, $tramo, $ci, mapeo $m) {
    $leds      = array();
    $ciclos = ( FPS * $tiempo );
    if (!($arriba)) 
      $colores = array_reverse($colores);
    if ($tramo<0) {
		 if ($ci<0) {      
         $cini = $this->ciclo;
         $this->ciclo += $ciclos;
       } else $cini = $ci;
       $tamanyo = $this->tamanyo;
       $tramoPos = 0;		    	
    } else {
       $cini = ( $ci<0 ? $this->upd_tramo($tramo, $ciclos) : $ci );
       deb("cini $cini");
       $tamanyo = $this->tramos[$tramo]->tamanyo;
       $tramoPos = $this->tramos[$tramo]->inicio;
    };

    $colores_numero = count($colores);
    $colores_iteracion = 0;
    $ciclos_color = (FPS * $tiempo_color);
    $cc = 1;
    for($i=0;$i<$ciclos;$i++) {    
      for($j=0;$j<$tamanyo;$j++) {
         array_push($leds, array($i, $j, $this->ce($colores[floor((($j+$colores_iteracion*$paso)%($colores_numero*$paso))/$paso)])));
         deb("i=" . $i . " j=" . $j . " color = '" . $this->ce($colores[floor((($j+$colores_iteracion*$paso)%($colores_numero*$paso))/$paso)]) . "' | ci=" . $colores_iteracion . " cn=" . $colores_numero . " %=" . (($j+$colores_iteracion)%($colores_numero*$paso)) . " /=" . ((($j+$colores_iteracion)%($colores_numero*$paso))/$paso) . " floor=" . floor((($j+$colores_iteracion)%($colores_numero*$paso))/$paso) );
      }
      if ($ciclos_color--<=1) {
         $colores_iteracion = $cc++ % $colores_numero;
         $ciclos_color = (FPS * $tiempo_color);
         deb("Colores iteracion " . $colores_iteracion);
      }
      deb("Ciclos color " . $ciclos_color);

    }
    deb("Mapeo => id=" . $this->id . " cini=" . $cini . " ciclos=" . $ciclos . " tP=" . $tramoPos);    
    $m->mapea_linea($this->linea_asociada,$cini,$ciclos,$tramoPos,$leds);
    return $cini;
   } 
 
// F: TIRA_SUBE
  function tira_sube($color, $tiempo, $arriba, $paso, $tramo, $ci, mapeo $m) {
    $leds      = array();
    $ciclos = ( FPS * $tiempo );  		  	
    if ($tramo<0) {
		 if ($ci<0) {      
         $cini = $this->ciclo;
         $this->ciclo += $ciclos;
       } else $cini = $ci;
       $tamanyo = $this->tamanyo;
       $tramoPos = 0;		    	
    } else {
       $cini = ( $ci<0 ? $this->upd_tramo($tramo, $ciclos) : $ci );
       $tamanyo = $this->tramos[$tramo]->tamanyo;
       $tramoPos = $this->tramos[$tramo]->inicio;
    };
    $num_ciclo = ($tamanyo) / $ciclos;    
    if ($arriba) {
      for ($i=0;$i<$ciclos;$i+=$paso) {
        $num = ($i+$paso)*$num_ciclo;
        for ($j=0; $j<$num;$j++) {
          for ($ii=0;$ii<$paso;$ii++) { 
            array_push($leds, array(($i+$ii),$j,$this->ce($color)));
            deb("i = " . ($i+$ii) . " j = " . $j . " num = " . $num . " num real = " . $i*$num_ciclo );
          }        
        }
      }
    } 
    else { 
      for ($i=0;$i<$ciclos;$i+=$paso) {
        $num = (($tamanyo-1)-$num_ciclo*($i+$paso));
        for ($j=($tamanyo-1); $j>$num;$j--) {
          for($ii=0;$ii<$paso;$ii++) {        	          
            array_push($leds, array($i+$ii,$j,$this->ce($color)));
            deb("i = " . ($i+$ii) . " j = " . $j . " num = " . $num);
          }
        }
      }
    }

//    deb(var_dump($leds));
    deb("Empiezooo...");
    deb("Id " . $this->id . " / Cini " . $cini . " / Ciclos " . $ciclos);
    
    $m->mapea_linea($this->linea_asociada,$cini,$ciclos,$tramoPos,$leds);
    return $cini;
  }

// F: TIRA_SUBE_SOLA -- NO TOCAR
  function tira_sube_sola2($color, $tiempo, $arriba, $paso , mapeo $m) {
    $leds      = array();
    $ciclos = ( FPS * $tiempo );
    $this->ciclo += $ciclos;
    $num_ciclo = ($this->tamanyo-($paso-1)) / $ciclos;
    if ($arriba) {
      $ini = 0;
      for ($i=0;$i<$ciclos;$i++) {
        $num = ($i+1)*$num_ciclo;
        for ($j=($num > $ini ? $ini : $jA); $j<$num; $j++, $ini++) {
          for($jj=0;$jj<$paso;$jj++) {         
            array_push($leds, array($i,($j+$jj),$this->ce($color)));
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
            array_push($leds, array($i,($j-$jj),$this->ce($color)));
            deb("i = " . ($i) . " j = " . ($j-$jj) . " num = " . $num);
          }
          $jA = $j;
        }
        }
    }
    $m->mapea_linea($this->linea_asociada,$cini,$ciclos,0,$leds);
  }

// F: TIRA_SUBE_SOLA  
  function tira_sube_sola($color, $tiempo, $arriba, $paso, $tramo, $ci, mapeo $m) {
    $leds      = array();
    $ciclos = ( FPS * $tiempo );
    if ($tramo<0) {
		 if ($ci<0) {      
         $cini = $this->ciclo;
         $this->ciclo += $ciclos;
       } else $cini = $ci;
       $tamanyo = $this->tamanyo;
       $tramoPos = 0;		    	
    } else {
       $cini = ( $ci<0 ? $this->upd_tramo($tramo, $ciclos) : $ci );
       $tamanyo = $this->tramos[$tramo]->tamanyo;
       $tramoPos = $this->tramos[$tramo]->inicio;
    };
    deb("Cini: " . $cini . " / tamanyo: " . $tamanyo . "/ tramoPos: " . $tramoPos . " / esquema = " . $this->esquema_de_color  );
    $num_ciclo = $tamanyo / $ciclos;
    if ($arriba) {
      $ini = 0;
      $jA = 0;
      for ($i=0;$i<$ciclos;$i++) {
        $num = ($i+1)*$num_ciclo;
        $ini = ($i)*$num_ciclo;
		  $pas = 0;
		  $dif = $num - $ini;
		  deb("num = $num / ini = $ini / dif = $dif");        
        for ($j=$ini; ($j<$num) ; $j++) {
				// Hacia arriba
				deb("Desde $j Hasta " . ($ini+($paso-$pas)) . " inc = $dif");
				for($jj=$j;$jj<$ini+($paso-$pas);$jj+=$dif) {
					if ($jj<$tamanyo) {
						array_push($leds, array($i,$jj,$this->ce($color)));
						deb("i=$i, jj=$jj, ce=$this->ce($color)");
						}
					}
				// Hacia abajo
				deb("Desde $j Hasta " . $ini . " dec = $dif");				
				for($jj=$j;$jj>$ini;$jj-=$dif) {
					if ($jj>0) {
						array_push($leds, array($i,$jj,$this->ce($color)));
						deb("i=$i, jj=$jj, ce=$this->ce($color)");
						}
					}        	      
            }
        if ($pas == $paso) $pas = 0; else $pas++;          
        }
    } 
    else {
      $ini = $tamanyo - 1; 
      for ($i=0;$i<$ciclos;$i+=$paso) {
        $num = (($tamanyo-1)-$num_ciclo*($i+$paso));
        for ($j=($num < $ini ? $ini : $jA); $j>$num;$j--, $ini--) {
          for($ii=0;$ii<$paso;$ii++) {        	
            array_push($leds, array($i+$ii,$j,$this->ce($color)));
            deb("i = " . ($i+$ii) . " j = " . $j . " num = " . $num . " color = " . $this->ce($color));
          }
          $jA = $j;
        }
        }
    }
    $m->mapea_linea($this->linea_asociada,$cini,$ciclos,$tramoPos,$leds);
//    deb("Ciclos: " . $this->ciclo . " - " . $this->tramos[0]->get_ciclo() . " - " . $this->tramos[1]->get_ciclo());
    return $cini;
  }



/*
// F: TIRA_SUBE_BRILLANTEº
  function tira_sube_brillante($colorbrillante, $nuevocolor, $arriba, $continua, $tiempo, mapeo $m) {
  	
  	
   }
*/

} // Fin de la clase brazo




?>