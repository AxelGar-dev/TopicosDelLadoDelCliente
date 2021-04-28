<?php
$iteradorDatos = 20;
$array;
for($i = 0; $i < $iteradorDatos; $i++) {
    $random = rand(1, 20);
    if($random > 0 && $random < 10){
        $array[] = rand(0, 100);
    }
    else if($random >= 10 && $random < 15){
        $array[] = "String";
    }
    else if($random >= 15 && $random < 20){
        $bandera = rand(0, 10);
        if($bandera % 2 == 0) {
            $array[] = true;
        }
        else {
            $array[] = false;
        }
    }
}

$resultado = "";
foreach ($array as $valor) {
    if(is_numeric($valor)){
        $suma = 1;
        for($i = 2; $i <= $valor; $i++){
            if($valor%$i==0){
                $suma++;
            }
        }
        if($suma == 2 || $valor == 1){
            $resultado.="<button>".$valor."</button><br><br>";
        }
    }
    else if(is_string($valor)){
        $resultado.="<input type='text' value='".$valor."'><br><br>";
    }
    else if(is_bool($valor)){
        $resultado.="<table border='1'>
            <tr>
                <td>boolean</td>
                <td>boolean</td>
            </tr>
            <tr>
                <td>boolean</td>
                <td>boolean</td>
            </tr>
        </table>
        <br>
        <br>";
    }
}
echo $resultado;