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

  private $lineas = array();
  private $lineas_cuenta = 0;
  private $fp;
  private $ft;
  private $ciclo;
  private $ciclo_numero;
  private $buffer = array();
  private $bufferi = array();


  
  function __construct($archivo) {
    $this->fp = fopen($archivo . ".dat","w+");
    $this->ft = fopen($archivo . ".txt","w+");
    fwrite($this->fp, chr(FPS) );
    fwrite($this->ft, FPS . "|");
/*    foreach($elementos as $e) {
		fwrite($this->ft, $e);    	
    }
*/ 
//   $this->bufferi = array_fill(0,$ciclo_numero,COLOR_BASE);
    $this->ciclo = 0;
    $this->ciclo_numero = 0; // $ciclo_numero;
    ob_flush();
    flush();
    fflush($this->fp);  
    fflush($this->ft);
  }

  function __destruct() {
    fclose($this->fp);
    fclose($this->ft);
  
  }
  
  
  function almacena() {
    $k = 0;
    $segundo = $this->ciclo_numero * FPS;
    deb("ALMACENANDO...");
    foreach ($this->buffer as $led) {
    	fwrite($this->ft, $led . "|");
    	fwrite($this->fp, rgb2chr($led));
    	if ($k++ % $segundo == 0) deb("Segundo almacenado...");
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
    
    // Mapear en el buffer
    foreach ($L as $LED) {
//      deb("Cini = " . $cini . " LED[0] = " . $LED[0] . " ciclo_numero = " . $this->ciclo_numero);
//      deb("Inicio del ciclo = " . ($cini + $LED[0])*$this->ciclo_numero);
//      deb("Desplazamiento = " . $this->lineas[$id]->A[ $tini + $LED[1] ]);
//      deb("Indice buffer = " . ($cini + $LED[0])*$this->ciclo_numero + $this->lineas[$id]->A[ $tini + $LED[1] ] );

      $this->buffer[ ($cini + $LED[0])*$this->ciclo_numero + $this->lineas[$id]->A[ $tini + $LED[1] ] ] = $LED[2];

    } 	
  }
  
  
  function setlinea(linea_mapeada $linea) {
    $linea->id = $this->lineas_cuenta++;
    $this->ciclo = 0;
    $this->ciclo_numero += $linea->devuelve_tamanyo();
    $this->bufferi = array_fill(0,$this->ciclo_numero,COLOR_BASE);
    array_push($this->lineas, $linea);
    return $linea->id;
  }
  
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
