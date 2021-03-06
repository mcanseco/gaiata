<?php

 $picasA = array("A1_" =>  36, "A2_" => 39, "A3_" => 42, "A4_" => 48, "A5_" => 48, "B1_" => 38, "B2_" => 32, "B3_" => 24);
 
 $aros = array("1" => 40, "2" => 80);

 $tramos = array("1" => 20, "2" => 15, "3" => 10, "4" => 30, "5" => 10, "6" => 20);
 
 $gaiato = 15;

 $fps = 16;

 $total = 0;

 foreach ($picasA as $pica => $numero) {
 	$total = $total + $numero;
 }
 foreach ($tramos as $t => $n) {
	$total = $total + ($n*4); 	
 	}
 foreach ($aros as $aro => $numero) {
 	$total = $total + $numero;
 }
 $total = $total + $gaiato;

?>
<!DOCTYPE html>
<html lang="es-es">
  <head>
      <meta charset="UTF-8">
      <title>Simulador con canvas</title>
  </head>
<body>

<input type="file" id="archivo" name="file" />
<button onClick="cargar()">Cargar el archivo</button>
<canvas id="myCanvas" width="1250" height="590" style="border:1px solid #000000;">
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
	var st_max = <?=($total)?>;
	var start = parseInt(0) || 0;
    	var longitud = parseInt(8*st_max);
    	var iteracion = 0;
    	var longitud_total = 0;

	var fps = <?=($fps)?>;
	var now;
	var then = Date.now();
	var interval = 1000/fps;
	var delta;

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
  
<?php  

//////  PICAS  //////
  
  $radioG = 275;
  $desplaza = 0;
  $inc = 30;
  $radio = 275;
  $y = 0;
  
  foreach ($picasA as $pica => $numero) {
  	
  
//  	$numero = 4;
//  	$pica = "A";
    
     	$angulo = 360 / $numero;
/*

	if ($pica=="B1_") {
		$desplaza = 400;
		$radio = 150;
		$inc = 20;
	}
 */
	for($i=0;$i<$numero;$i++) {
     		

?>	
	ctx.beginPath();
	ctx.arc(<?=($radio*cos(deg2rad($angulo*$i+180)) + $radioG + $desplaza)?>+10,<?=($radio*sin(deg2rad($angulo*$i+180)) + $radioG )?>+10,5,0,2*Math.PI);
	ctx.fillStyle = datos[<?=($y)?>];
	ctx.fill();
	ctx.closePath();

	
<?php

	$y++;
	}
  $radio-=$inc;
  }

//////  AROS    ///////


  $desplazaX = 750;
  $desplazaY = 400;
  $inc = 30;
  $radio = 130;
  $y = 0;
  
  foreach ($aros as $aro => $numero) {
  	
     
     	$angulo = 360 / $numero;
 
	for($i=0;$i<$numero;$i++) {
     		

?>	
	ctx.beginPath();
	ctx.arc(<?=($radio*cos(deg2rad($angulo*$i+100)) + $desplazaX)?>+10,<?=($radio*sin(deg2rad($angulo*$i+100)) + $desplazaY )?>+10,5,0,2*Math.PI);
	ctx.fillStyle = datos[<?=($y)?>];
	ctx.fill();
	ctx.closePath();


<?php

	$y++;
	}
  $radio-=$inc;
  }




//////  BRAZOS  //////

$z = 0;
foreach ($tramos as $t => $n ) {

	for ($i=0;$i<4;$i++) {
     
     	   for ($j=0;$j<$n;$j++) {
?>	
		ctx.beginPath();
		ctx.arc(<?=(950 + $i*50)?>,<?=(570-($j+$z)*5)?>,2,0,2*Math.PI);
		ctx.fillStyle = datos[<?=($y)?>];
		ctx.fill();
		ctx.closePath();

	
<?php
		$y++;	
		}
	}
	$z= $z + $n + 1;

}

///// GAIATO //////

     	   for ($j=0;$j<$gaiato;$j++) {
?>	
		ctx.beginPath();
		ctx.arc(<?=(1000 + $i*50)?>,<?=(95-($j)*5)?>,2,0,2*Math.PI);
		ctx.fillStyle = datos[<?=($y)?>];
		ctx.fill();
		ctx.closePath();

	
<?php
		$y++;	
		}




?>
    } 
	
}
		
	

</script> 


</body>
</html>
