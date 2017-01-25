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
  public  $gaiato = array();
  private $gaiato_cuenta = 0;
  private $tamanyo = 0;

  // Conexionado
  public $mapeo;

  function __construct($fisico, $logico, $nombre_archivo) {
		$this->mapeo = new mapeo($nombre_archivo);
      // Brazos		
		for ($i=0;$i<BRAZOS_NUM;$i++) {
			$idL = $this->mapeo->set_linea();			
			$idB = $this->set_brazo($idL,$fisico[0][0]);			
			foreach ($fisico[0][1] as $tr) { 
				$this->mapeo->lineas[$idL]->trama($this->devuelve_tamanyo(),$tr[0],$tr[1]);	
			}
			foreach ($logico[0] as $tr) {
				$this->brazos[$idB]->set_tramo(new tramo($tr[0],$tr[1]));
			}
		}
	 // Aros
	
}      	
      	
      }
      
      
  }



  
  function set_brazo($linea, $esquema) {
  	  $id = $this->brazos_cuenta++;
     $this->brazos[$id] = new brazo($linea,$esquema);
     return $id;
/*    $brazo->id = $this->brazos_cuenta++;
    array_push($this->brazos, $brazo);
*/  }

function set_pica(pica $pica) {
    $pica->id = $this->picas_cuenta++;
    array_push($this->picas, $pica);
   } 

function set_aro(aro $aro) {
    $aro->id = $this->aros_cuenta++;
    array_push($this->aros, $aro);
   } 

function set_gaiato(gaiato $gaiato) {
    $aro->id = $this->gaiato_cuenta++;
    array_push($this->gaiato, $gaiato);
   } 

  function set_mapeo(mapeo $mapeo) {
    $this->mapeo = $mapeo;
  }  




}


?>
