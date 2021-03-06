<?php

 $picasA = array("A1_" => 40, "A2_" => 40, "A3_" => 42, "A4_" => 39, "A5_" => 36, "B1_" => 38, "B2_" => 32, "B3_" => 24, "B4_" => 26);

 $picasB = array(38,32,24,26);

 $total = 0;
 $radio = 10;

 foreach ($picasA as $pica => $numero) {
 	$total = $total + $numero;
 }

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
  
  $radioG = 150;
  $desplaza = 0;
  $radio = $radioG;
  $y = 0;
  
  foreach ($picasA as $pica => $numero) {
  	
  
//  	$numero = 4;
//  	$pica = "A";
    
     	$angulo = 360 / $numero;

	if ($pica=="B1_") {
		$desplaza = 400;
		$radio = 150;
	}
 
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
  $radio-=20;
  }

?>

	requestAnimationFrame(draw);
}
		
	

</script> 


</body>
</html>
