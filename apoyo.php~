<?php
/* *** Funciones de APOYO *** */


// Conversión de COLORES

function rgb2chr($rgb) {
  $r = hexdec(substr($rgb,1,2));
  $g = hexdec(substr($rgb,3,2));
  $b = hexdec(substr($rgb,5,2));
  return(chr($r) . chr($g) . chr($b) );
}

function rgb_bytes2txt($r,$g,$b) {
  return ( "#" . ($r<16 ? "0" . dechex($r) : dechex($r)) . ($g<16 ? "0" . dechex($g) : dechex($g)) . ($b<16 ? "0" . dechex($b) : dechex($b))  );
}

// Por si acaso...
function rgb_txt2bytes($rgb) {
  $r = hexdec(substr($rgb,1,2));
  $g = hexdec(substr($rgb,3,2));
  $b = hexdec(substr($rgb,5,2));
  return(array($r,$g,$b));
}

// RGB en formato texto a HSV como array
function rgb2hsv($rgb) {
  $r = hexdec(substr($rgb,1,2));
  $g = hexdec(substr($rgb,3,2));
  $b = hexdec(substr($rgb,5,2));
  $var_R = ( $r / 255 );                     //RGB from 0 to 255
  $var_G = ( $g / 255 );
  $var_B = ( $b / 255 );
  $var_Min = min( $var_R, $var_G, $var_B );    //Min. value of RGB
  $var_Max = max( $var_R, $var_G, $var_B );    //Max. value of RGB
  $del_Max = $var_Max - $var_Min;             //Delta RGB value
  $V = $var_Max;
  if ( $del_Max == 0 )                     //This is a gray, no chroma...
   {
     $H = 0;                                //HSV results from 0 to 1
     $S = 0;
   }
  else                                    //Chromatic data...
  {
     $S = $del_Max / $var_Max;
     $del_R = ( ( ( $var_Max - $var_R ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
     $del_G = ( ( ( $var_Max - $var_G ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
     $del_B = ( ( ( $var_Max - $var_B ) / 6 ) + ( $del_Max / 2 ) ) / $del_Max;
     if       ( $var_R == $var_Max ) $H = $del_B - $del_G;
       else if ( $var_G == $var_Max ) $H = ( 1 / 3 ) + $del_R - $del_B;
       else if ( $var_B == $var_Max ) $H = ( 2 / 3 ) + $del_G - $del_R;
     if ( $H < 0 ) $H += 1;
     if ( $H > 1 ) $H -= 1;
  }
  return( array("H" => $H, "S" => $S, "V" => $V) );
}

// HSV como array a RGB en formato texto
function hsv2rgb($hsv) {
	$H = $hsv['H'];
	$S = $hsv['S'];
	$V = $hsv['V'];
	if ( $S == 0 )                       //HSV from 0 to 1
	{
	   $R = $V * 255;
	   $G = $V * 255;
	   $B = $V * 255;
	}
	else
	{
	   $var_h = $H * 6;
	   if ( $var_h == 6 ) $var_h = 0;      //H must be < 1
	   $var_i = (int) $var_h ;             //Or ... var_i = floor( var_h )
	   $var_1 = $V * ( 1 - $S );
	   $var_2 = $V * ( 1 - $S * ( $var_h - $var_i ) );
	   $var_3 = $V * ( 1 - $S * ( 1 - ( $var_h - $var_i ) ) );
	   if      ( $var_i == 0 )  { $var_r = $V     ; $var_g = $var_3 ; $var_b = $var_1; }
	   else if ( $var_i == 1 ) { $var_r = $var_2 ; $var_g = $V     ; $var_b = $var_1; }
	   else if ( $var_i == 2 ) { $var_r = $var_1 ; $var_g = $V     ; $var_b = $var_3; }
	   else if ( $var_i == 3 ) { $var_r = $var_1 ; $var_g = $var_2 ; $var_b = $V;     }
	   else if ( $var_i == 4 ) { $var_r = $var_3 ; $var_g = $var_1 ; $var_b = $V;     }
	   else                     { $var_r = $V     ; $var_g = $var_1 ; $var_b = $var_2; }
	   $R = $var_r * 255;                  //RGB results from 0 to 255
	   $G = $var_g * 255;
	   $B = $var_b * 255;  
	}
	return rgb_bytes2txt($R,$G,$B);
}

// DEGRADADO: ENTRE DOS COLORES
function degradado_de_a($rgbi, $rgbf, $iteraciones) {
  $rgbBi = rgb_txt2bytes($rgbi);
  $rgbBf = rgb_txt2bytes($rgbf);
  $dif   = array(($rgbBf[0]-$rgbBi[0])/$iteraciones,($rgbBf[1]-$rgbBi[1])/$iteraciones, ($rgbBf[2]-$rgbBi[2])/$iteraciones );
  //var_dump($dif);
  $res   = array();
  for ($i=0;$i<=$iteraciones;$i++) {
    array_push($res, rgb_bytes2txt( ($rgbBi[0] + $i*$dif[0]) , ($rgbBi[1] + $i*$dif[1])  , ($rgbBi[2] + $i*$dif[2]) )); 
  }
  return $res;
}

// DEGRADADO: ACLARA(true) o OBSCURECE(false)
function degradado_ao($rgb, $iteraciones, $porcentaje, $aclara_obscurece) {
  $res = array();
  $hsv = rgb2hsv($rgb);
  if ($aclara_obscurece)
    $paso = ((1*($porcentaje/100)) - $hsv['V']) / $iteraciones;
  else
    $paso = -1*(($porcentaje/100)*$hsv['V']) / $iteraciones;
  
  for ($i=0;$i<=$iteraciones;$i++) {
    array_push($res, hsv2rgb (array('H' => $hsv['H'],'S' => $hsv['S'],'V' => $hsv['V']+$paso*$i)));
  }
  return $res;
}

?>
