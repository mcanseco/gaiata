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
		$act = 0;      
      // Brazos		
		for ($i=0;$i<BRAZOS_NUM;$i++) {
			$idL = $this->mapeo->set_linea();			
			$idB = $this->set_brazo($idL,$fisico[0][0]);
			foreach ($fisico[0][1] as $tr) { 
				$this->mapeo->set_trama($idL,$act,$tr);
				$act +=$tr[0];	
			}
			foreach ($logico[0] as $tr) {
				$this->brazos[$idB]->set_tramo(new tramo($tr[0],$tr[1]));
			}
		}
	 // Aros
	 for ($i=0;$i<count($logico[1]);$i++) {
			$idL = $this->mapeo->set_linea();			
			$idB = $this->set_aro($idL,$fisico[1][0]);					
		  $this->mapeo->set_trama($idL,$act,$fisico[1][1][$i]);
		  $act += $fisico[1][1][$i][0];
		  $cociente = floor(($fisico[1][1][$i][0]-count($fisico[1][1][$i][1]))) / $logico[1][$i];
		  $resto = ($fisico[1][1][$i][0]-count($fisico[1][1][$i][1])) % $logico[1][$i];
		  for ($k=0;$k<($logico[1][$i]-1);$k++) {
				$this->aros[$idB]->set_tramo(new tramo($cociente*$k,$cociente));
		  	}
		  $this->aros[$idB]->set_tramo(new tramo($cociente*($logico[1][$i]-1),$cociente+$resto));	
	 }
	 // Picas
	 for ($i=0;$i<count($logico[2]);$i++) {
			$idL = $this->mapeo->set_linea();			
			$idB = $this->set_pica($idL,$fisico[2][0]);					
		  $this->mapeo->set_trama($idL,$act,$fisico[2][1][$i]);
		  $act += $fisico[2][1][$i][0];
		  $cociente = floor(($fisico[2][1][$i][0]-count($fisico[2][1][$i][1]))) / $logico[2][$i];
		  $resto = ($fisico[2][1][$i][0]-count($fisico[2][1][$i][1])) % $logico[2][$i];
		  for ($k=0;$k<($logico[2][$i]-1);$k++) {
				$this->picas[$idB]->set_tramo(new tramo($cociente*$k,$cociente));
		  	}
		  $this->picas[$idB]->set_tramo(new tramo($cociente*($logico[2][$i]-1),$cociente+$resto));	
	 }
	 // Gaiato
	 $idL = $this->mapeo->set_linea();			
	 $idB = $this->set_gaiato($idL,$fisico[3][0]);					
	 $this->mapeo->set_trama($idL,$act,$fisico[3][1][0]);
	 $act += $fisico[3][1][0][0];
	 $this->gaiato[0]->set_tramo(new tramo(0,$fisico[3][1][0][0]-count($fisico[3][1][0][1])));	
}      	
  
  function set_brazo($linea, $esquema) {
  	  $id = $this->brazos_cuenta++;
     $this->brazos[$id] = new brazo($linea,$esquema);
     return $id;
  }

function set_pica($linea, $esquema) {
  	  $id = $this->picas_cuenta++;
     $this->picas[$id] = new pica($linea,$esquema);
     return $id;
   } 

  function set_aro($linea, $esquema) {
  	  $id = $this->aros_cuenta++;
     $this->aros[$id] = new aro($linea,$esquema);
     return $id;
   } 

function set_gaiato($linea, $esquema) {
     $id = $this->gaiato_cuenta++;
     $this->gaiato[$id] = new gaiato($linea,$esquema);
     return $id;

   } 

  function set_mapeo(mapeo $mapeo) {
    $this->mapeo = $mapeo;
  }  




}


?>
