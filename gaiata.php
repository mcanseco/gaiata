<?php

require_once("config.php");
require_once("apoyo.php");
require_once("mapeo.php");
require_once("componente.php");

class brazo extends componente {
	
}

class pica extends componente {
	
} 

class gaiata {

  // Elementos de la Gaiata
  public  $brazos = array();
  private $brazos_cuenta = 0;
  public  $picas = array();
  private $picas_cuenta = 0;
  // Conexionado
  public $mapeo;
  
  function set_brazo(brazo $brazo) {
    $brazo->id = $this->brazos_cuenta++;
    array_push($this->brazos, $brazo);
  }

function set_pica(pica $pica) {
    $brazo->id = $this->picas_cuenta++;
    array_push($this->picas, $picas);
   } 

  function set_mapeo(mapeo $mapeo) {
    $this->mapeo = $mapeo;
  }  

}


?>
