<?php

require_once("gaiata_simulada.php");

 
 $g = new gaiata_simulada(array($tramos_brazos_fisico,$aros_fisico,$picas_fisico,$gaiato),array($tramos_brazos_logico,$aros_logico,$picas_logico),"patataaa");


?>
<!DOCTYPE html>
<html lang="es-es">
  <head>
      <meta charset="UTF-8">
      <title>Simulador con canvas</title>
      
<script>

function cargar(){

//    console.log("Entro");
    var files = document.getElementById('archivo').files;
    if (!files.length) {
      alert('No se ha seleccionado un archivo');
      return;
    }

    var file = files[0];
    var reader = new FileReader();
   
    reader.onloadend = function(evt) {
    if (evt.target.readyState == FileReader.DONE) { // DONE == 2
//	console.log("Lo ha cargado");
        lectura = evt.target.result;
        longitud_total = lectura.lenght;
        requestAnimationFrame(draw);
    }


    };

    reader.readAsBinaryString(file); 
//    console.log("Ejecuto el reader");   
}



function draw(){

  requestAnimationFrame(draw);
  
  now = Date.now();
  delta = now - then;
  
  if (delta > interval) {
  
  	then = now - (delta % interval);

	var start = parseInt(iteracion*(st_max*8)) || 0;
	var datos = lectura.substr(start,longitud).split('|');
//	console.log(iteracion);
//	console.log(start);
//	console.log(lectura.substr(start,longitud));
    	iteracion++;	
    	if (longitud_total<start) return;
    	
//        console.log(datos[0]);
    	
	
	ctx.clearRect(0,0,1250,590);
  
<? 
	$g->dibuja_brazos(); 
	$g->dibuja_aros();
	$g->dibuja_picas();
	$g->dibuja_gaiato();
?>

  }
} 		

</script> 
      
  </head>
<body>

<input type="file" id="archivo" name="file" />
<button onClick="cargar()">Cargar el archivo</button>
<canvas id="myCanvas" width="1250" height="590" style="border:1px solid #000000;background-color: #000000">
</canvas>
<script>
	
	var requestAnimationFrame = window.requestAnimationFrame ||
                            window.mozRequestAnimationFrame ||
                            window.webkitRequestAnimationFrame ||
                            window.msRequestAnimationFrame;
                            
        window.cancelRequestAnimFrame = ( function() {
    return window.cancelAnimationFrame          ||
        window.webkitCancelRequestAnimationFrame    ||
        window.mozCancelRequestAnimationFrame       ||
        window.oCancelRequestAnimationFrame     ||
        window.msCancelRequestAnimationFrame        ||
        clearTimeout
} )();
                            
	var c = document.getElementById("myCanvas");
	var ctx = c.getContext("2d");	
	var lectura;
	var st_max = <?=($g->mapeo->devuelve_tamanyo())?>;
	var start = parseInt(0) || 0;
    	var longitud = parseInt(8*st_max);
 	   	var iteracion = 0;
    	var longitud_total = 0;

	var fps = <?=(FPS)?>;
	var now;
	var then = Date.now();
	var interval = 1000/fps;
	var delta;

</script>
</body>
</html>
