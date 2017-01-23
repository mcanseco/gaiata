<?php

require_once("config.php");
require_once("apoyo.php");
require_once("mapeo.php");
require_once("componente.php");

class brazo extends componente {
}

class pica extends componente {
} 

class aro extends componente {
	}
	
class gaiato extends componente {	
}

class gaiata {

  // Elementos de la Gaiata
  public  $brazos = array();
  private $brazos_cuenta = 0;
  public  $picas = array();
  private $picas_cuenta = 0;
  public  $aros = array();
  private $aros_cuenta = 0;
  public  $gaiato;

  // Conexionado
  public $mapeo;
  
  function set_brazo(brazo $brazo) {
    $brazo->id = $this->brazos_cuenta++;
    array_push($this->brazos, $brazo);
  }

function set_pica(pica $pica) {
    $pica->id = $this->picas_cuenta++;
    array_push($this->picas, $pica);
   } 

function set_aro(aro $aro) {
    $aro->id = $this->aros_cuenta++;
    array_push($this->aros, $aro);
   } 

function set_gaiato(gaiato $gaiato) {
    $this->gaiato = $gaiato;
   } 

  function set_mapeo(mapeo $mapeo) {
    $this->mapeo = $mapeo;
  }  

}


?>
