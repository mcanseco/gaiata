<?php

require_once "config.php";


class linea_mapeada {

  public $id;
  public $A = array();
  private $Ac = 0;
  private $ciclo = 0;
  private $tamanyo = 0;
 

  function devuelve_valor() {
    return $this->id;
  }
 
  
   
  function trama($inicio,$tamanyo,$ocultas) {    
    array_push($ocultas,$tamanyo);
    $oi = 0;    
    for ($t=0;$t<$tamanyo;$t++) {      
      if ($t<$ocultas[$oi]) {
        $this->A[$this->Ac++] = $t + $inicio;        
      } else {      
        if ($t == $ocultas[$oi] ) {
          $oi++;
        }
      }
    }
    $this->tamanyo += $tamanyo;   
  }

  function devuelve_tamanyo_visible() {
		return $this->Ac;  	
  	}

  function devuelve_tamanyo() {
		return $this->tamanyo;  	
  	}  
  
  function muestra_A() {
    
    foreach ($this->A as $av) {
      echo $av . "</br> \n";
    }
  
  }
     
}


class mapeo {

  public  $lineas = array();
  public  $lineas_cuenta = 0;
  private $fp;
  private $ft;
  private $ciclo = 0;
  private $ciclo_numero = 0;
  private $buffer = array();
  private $bufferi = array();
  private $simulacion;

  
  function __construct($archivo,$simulacion) {
  	$this->simulacion = $simulacion;
  	if (!($simulacion)) {
    $this->fp = fopen($archivo . ".dat","w+");
    $this->ft = fopen($archivo . ".txt","w+");
    fwrite($this->fp, chr(FPS) );
    $this->ciclo = 0;
    $this->ciclo_numero = 0; // $ciclo_numero;
    ob_flush();
    flush();
    fflush($this->fp);  
    fflush($this->ft);
   }
  }

  function __destruct() {
  	if (!($this->simulacion)) {   
    fclose($this->fp);
    fclose($this->ft);
   }
  
  }
  
  
  function almacena() {
    $k = 0;
    $segundo = $this->ciclo_numero * FPS;
    debOK("ALMACENANDO... Ciclo= $this->ciclo_numero / Ciclos=$this->ciclo");
    
    foreach ($this->buffer as $led) {
    	fwrite($this->ft, $led . "|");
    	fwrite($this->fp, rgb2chr($led));
    	if ($k++ % $segundo == 0) debOK("Segundo almacenado...");
    }
    ob_flush();
    flush();
    fflush($this->fp);  
    fflush($this->ft);
  }
  
  function mapea_linea($id, $cini, $ciclos, $tini, $L) {
    
    // Añadir los ciclos que faltan
    $ciclos_que_faltan = ($cini+$ciclos) - $this->ciclo;
    if ($ciclos_que_faltan>0) 
      for ($k=0; $k<$ciclos_que_faltan; $k++) {
        $this->buffer = array_merge($this->buffer, $this->bufferi);
        $this->ciclo++;
      }
    debOK("-- Mapeo linea $id / Cini $cini / Tini $tini  / Ciclos $ciclos ");
    // Mapear en el buffer
    foreach ($L as $LED) {
//      deb("Cini = " . $cini . " LED[0] = " . $LED[0] . " ciclo_numero = " . $this->ciclo_numero);
//      deb("Inicio del ciclo = " . ($cini + $LED[0])*$this->ciclo_numero);
//      deb("Desplazamiento = " . $this->lineas[$id]->A[ $tini + $LED[1] ]);
//      deb("Indice buffer = " . ($cini + $LED[0])*$this->ciclo_numero + $this->lineas[$id]->A[ $tini + $LED[1] ] );

      $this->buffer[ ($cini + $LED[0])*$this->ciclo_numero + $this->lineas[$id]->A[ $tini + $LED[1] ] ] = $LED[2];

    } 	
  }

  function set_linea() {
	  $id = $this->lineas_cuenta++;    
    $this->lineas[$id] = new linea_mapeada();	  	
    $this->lineas[$id]->id = $id;
    $this->ciclo = 0;
    return $id;        	  	
  	}  

  function devuelve_tamanyo() { return $this->ciclo_numero; }  
  
  function set_trama($lineaId, $act, $trama) {
//  	  echo "lineaId=$lineaId  act=$act trama0=$trama[0] trama1=$trama[1] </br>";
	  $this->lineas[$lineaId]->trama($act,$trama[0],$trama[1]);
    $this->ciclo_numero += $trama[0];
    $this->bufferi = array_fill(0,$this->ciclo_numero,COLOR_BASE);   
  	}


/* Obsoleto
  
  function setlinea(linea_mapeada $linea) {
    $linea->id = $this->lineas_cuenta++;
    $this->ciclo = 0;
    $this->ciclo_numero += $linea->devuelve_tamanyo();
    $this->bufferi = array_fill(0,$this->ciclo_numero,COLOR_BASE);
    array_push($this->lineas, $linea);
    return $linea->id;
  }
*/
  
  function muestra_A($i) {
    
    $this->lineas[$i]->muestra_A();
  
  }

  function lista_lineas() {
    foreach ($this->lineas as $linea) {
      echo $linea->devuelve_valor() . "</br> \n";
    }
  }
  
  function devuelve_linea($identificador) {
    echo $this->lineas[$identificador]->devuelve_valor() . "</br> \n";
  }
}

?>
