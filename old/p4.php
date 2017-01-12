<?php

class linea_mapeada {

  private $id;
  private $A = array();
  private $Ac = 0;
    
  function __construct($identificacion) {
    $this->id = $identificacion;
  }

  function devuelve_valor() {
    return $this->id;
  }
  
  function trama($inicio,$fin,$ocultas) {
    array_push($ocultas,$fin+1);
    $oi = 0;    
    for ($t=$inicio;$t<=$fin;$t++) {      
      if ($t<$ocultas[$oi]) {
        $this->A[$this->Ac] = $t;
        $this->Ac++;        
      } else {      
        if ($t == $ocultas[$oi] ) {
          $oi++;
        }
      }
    }  
  }
    
  function muestra_A() {
    
    foreach ($this->A as $av) {
      echo $av . "</br> \n";
    }
  
  }
     

}


class mapeo {

  private $lineas = array();
  private $fp;
  private $ft;
  private $ciclo;
  private $fps;
  private $bufferP = array();
  private $bufferT = array();
  private $bufferPi = array();
  private $bufferTi = array();

  
  function __construct($archivo, $ciclo, $fps) {
    $this->fp = fopen($archivo . ".dat","w+");
    $this->ft = fopen($archivo . ".txt","w+");
    $this->ciclo = $ciclo;
    $this->fps = $fps;
  }

  function __destruct() {
    fclose($this->fp);
    fclose($this->ft);
  
  }
  
  function setlinea(linea_mapeada $linea) {
    
    array_push($this->lineas, $linea);
  
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

echo "Empiezo </br> \n";

$m = new mapeo();

$l = new linea_mapeada(0);

$l->trama(10,17,array (12,13,15));
$l->trama(20,26,array(23,24,26));

//$l->muestra_A();

$m->setlinea($l);

$m->muestra_A(0);
//$m->lista_lineas();


/*
for ($i=0;$i<10;$i++) {
  $l = new linea_mapeada($i);
  $m->setlinea($l);
 
}

echo "Lista de mapeos </br> \n";

 $m->lista_lineas();

echo "Aleatorios </br> \n";

 $m->devuelve_linea(3);
 $m->devuelve_linea(2);
 
*/
echo "Fin de la prueba </br> \n";

?>
