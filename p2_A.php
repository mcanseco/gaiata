<?php

 $picasA = array("A1_" => 40, "A2_" => 40, "A3_" => 42, "A4_" => 39, "A5_" => 36, "B1_" => 38, "B2_" => 32, "B3_" => 24, "B4_" => 26);

 $picasB = array(38,32,24,26);
 

?>
<!DOCTYPE HTML>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <title>Ejemplo::Paisaje en CSS3</title>

		<style type="text/css">

<?php 

$radioG = 10;
$desplaza = 0;
$radio = $radioG;

foreach ($picasA as $pica => $numero) {

 	$angulo = 360 / $numero;

	if ($pica=="B1_") {
		$desplaza = 25;
		$radio = 10;
	}
 
	for($i=0;$i<$numero;$i++) {
	
  
?>

.<?=($pica)?><?=($i)?>{
	width:  0.5em;
   height: 0.5em;
   -moz-border-radius: 50%;
   -webkit-border-radius: 50%;
   border-radius: 50%;
   background-color: <?php if($i==0) echo "#FF0000;"; elseif($i==1) echo "#00FF00;"; else echo "#0000FF;"; ?>
   position: fixed;
   top: <?=($radio*sin(deg2rad($angulo*$i+180)) + $radioG )?>em;
   left: <?=($radio*cos(deg2rad($angulo*$i+180)) + $radioG + $desplaza)?>em;	
	}

<?php

	}
	
	$radio-=1;
}

?>

		</style>

<script type="text/javascript" >

function cargar() {

    var files = document.getElementById('archivo').files;
    if (!files.length) {
      alert('No se ha seleccionado un archivo');
      return;
    }

    var file = files[0];
    
    var st_max = 20;
    
    var start = parseInt(0) || 0;
    var stop = parseInt(8*st_max) || file.size - 1;
    var iteracion = 1;
    var reader = new FileReader();
   
   reader.onloadend = function(evt) {
    if (evt.target.readyState == FileReader.DONE) { // DONE == 2
        var lectura = evt.target.result;
        console.log("Buffer: " + lectura);
    	var datos = lectura.split('|'); 
<?php
	for ($x=0;$x<20;$x++) {
	//   echo "console.log(datos[" . $x . "]); ";
	//   echo "console.log('en A1_" . $x ."'); ";	
	   echo "document.getElementById('A1_" . $x ."').style.backgroundColor = datos[" . $x . "]; \n";	
	}
?>    	
   
        
        }
    };
   
  var intervalo = setInterval(function() {  
    
    
    console.log("Interacción: Inicio = " + start + " Fin = " + stop + " \n");
    
    if (file.webkitSlice) {
      var blob = file.webkitSlice(start, stop + 1);
    } else if (file.slice) {
      var blob = file.slice(start, stop + 1);
    }
    reader.readAsBinaryString(blob);
    
    start = parseInt(iteracion*(st_max*8)) || 0;
    stop = parseInt(start+(st_max*8)) || file.size - 1;
    
    iteracion++;

    if (file.size<=stop) clearInterval(intervalo);
    
   },200);
        
 }




</script>

   </head>
   <body>
<?php 

foreach ($picasA as $pica => $numero) {

	for($i=0;$i<$numero;$i++) {

?>        
      <div id="<?=($pica)?><?=($i)?>" class="<?=($pica)?><?=($i)?>"></div>
<?php } } ?>

<input type="file" id="archivo" name="file" />
<button onClick="cargar()">Cargar el archivo</button>

   </body>
</html> 
		
