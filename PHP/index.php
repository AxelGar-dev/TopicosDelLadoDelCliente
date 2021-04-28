<?php
$elementos = 15;
$arreglo;
for($i=0;$i<$elementos;$i++){
    $arreglo[] = obtenerDatoRandom();
}

$contenido = "";
foreach ($arreglo as $valor) {
    if(is_numeric($valor)){
        $sumatoria=1;
        for($i=2; $i<=$valor;$i++){
            if($valor%$i==0){
                $sumatoria++;
            }
        }
        if($sumatoria==2 || $valor==1){
            $contenido.="<button>".$valor."</button><br>";
        }
    }
    else if(is_string($valor)){
        $contenido.="<input type='text' value='".$valor."'>";
    }
    else if(is_bool($valor)){
        $contenido.="<table border='1'>
            <tr>
                <td>Este</td>
                <td>Es</td>
            </tr>
            <tr>
                <td>un</td>
                <td>boleano</td>
            </tr>
        </table>";
    }
}
echo $contenido;
function rellenar($arreglo){
    for($it=0;$it<$elementos;$it++){
        $arreglo[] = getValor();
    }
}

function obtenerDatoRandom(){
    $random = rand(0, 15);
    if($random>0 && $random<5){
        return rand(0, 100);
    }
    else if($random>=5 && $random<10){
        return "Cadena";
    }
    else if($random>=10 && $random<15){
        return (rand(0, 10)<5)?true:false;
    }
}
