<?php
$palabras = array("Comida", "Carrera", "Gran persona", "Laberinto", "Cama");
$niveles = count($palabras);
$letras = "";
$style = "";
$imagen = "";
$nivel = 0;
$teclado = "";
$teclasDesabilitadas = "";
$posicionCampo;
$valorCampo = "";
if(isset($_POST['start'])) {
    $style = "display: none;";
    $cadena = $palabras[$nivel];
    for($i = 0; $i < strlen($cadena); $i++) {
        if($cadena[$i] == " ") {
            $letras .= "<p style='margin-left: 20px; margin-right: 20px;'></p>";
        }
        else {
            $letras .= "<input type='text' autocomplete='off' class='lyrics' id='$i' readonly style='margin-right: 5px;'>";
        }
    }
    crearTeclado("");
}
if(isset($_POST['btnLetra'])) {
    $style = "display: none;";
    $teclasDesabilitadas = $_POST['teclas'];
    crearTeclado($_POST['btnLetra']);
    // comprobarCaracter($_POST['btnLetra'], $_POST['nivel']);
}

function crearTeclado($teclaPresionada) {
    global $teclado;
    global $teclasDesabilitadas;
    if($teclasDesabilitadas != "") {
        $arrayTeclas = explode($teclasDesabilitadas, "-");
        asort($arrayTeclas);
        $j = 0;
        for($i=65; $i<=90; $i++) {
            $letter = chr($i);
            if($j < count($arrayTeclas)) {
                if($arrayTeclas[$j] == $letter) {
                    $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='disabled' disabled>";
                }
            }
            if($letter == $teclaPresionada) {
                $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='disabled' disabled>";
                $teclasDesabilitadas .= $letter. "-";
            }
            else {
                $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='enabled' enabled>";
            }
        }
        $j++;
    }
    else {
        for($i=65; $i<=90; $i++) {
            $letter = chr($i);
            if($letter == $teclaPresionada) {
                $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='disabled' disabled>";
                $teclasDesabilitadas .= $letter. "-";
            }
            else {
                $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='enabled' enabled>";
            }
        }
    }
}

function comprobarCaracter($teclaPresionada, $nivelActual) {
    $cadena = $palabras[$nivelActual];
    $banderaTecla = 0;
    for($i = 0; $i < strlen($cadena); $i++) {
        if($cadena[$i] == " ") {
            $letras .= "<p style='margin-left: 20px; margin-right: 20px;'></p>";
        }
        elseif($cadena[$i] == $teclaPresionada) {
            $letras .= "<input type='text' value='$teclaPresionada' autocomplete='off' class='lyrics' id='$i' readonly style='margin-right: 5px;'>";
            $banderaTecla = 1;
        }
        else {
            $letras .= "<input type='text' autocomplete='off' class='lyrics' id='$i' readonly style='margin-right: 5px;'>";
        }
    }
    $teclado = crearTeclado($teclaPresionada);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahorcado</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .container {
            margin: auto;
            width: 250px;
            height: 230px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .input-container {
            margin: auto;
            margin-top: 50px;
            margin-bottom: 30px;
            width: 1000px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .instructions {
            position: absolute;
            top: 0;
            left: 0;
        }

        .instructions #start {
            width: 50px;
            height: 30px;
            border-radius: 3px;
            border: none;
            outline: none;
            color: #fff;
            background: #64dd17;
            cursor: pointer;
        }

        .input-container .lyrics {
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: 1px solid #000;
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 20px;
        }

        .input-container p {
            font-size: 30px;
            font-weight: bold;
        }

        .teclado {
            width: 50%;
            margin: 0 auto;
            text-align: center;
        }
        .teclado input {
            width: 50px;
            height: 50px;
            cursor: pointer;
            margin: 3px;
            border: 1px solid #2b2;
        }

        .teclado input:enabled {
            background-color: #2b2;
        }

        .teclado input:disabled {
            background-color: #aaa;
            border: 1px solid #aaa;
            cursor: auto;
        }
    </style>
</head>
<body>
    <div class="instructions">
        <h1>Ahorcado</h1>
        <p class="level">Nivel: </p>
        <p class="track">Errores: </p>
        <form action="" method="POST" style="<?php echo $style; ?>">
            <input type="submit" id="start" name="start" value="Iniciar">
        </form>
    </div>
    <div class="container">
        <img src="<?php echo $imagen; ?>" alt="" class="hanged" id="hanged">
    </div>
    <div class="input-container">
        <?php echo $letras; ?>
    </div>
    <div>
        <form action="" method="POST" name="miFormulario" class="teclado">
            <?php echo $teclado; ?>
            <input type="hidden" name="nivel" value="<?php echo $nivel?>">
            <!-- <input type="hidden" name="posicion" value="<?php echo $posicionCampo; ?>">
            <input type="hidden" name="valor" value="<?php echo $valorCampo; ?>"> -->
            <input type="hidden" name="teclas" value="<?php echo $teclasDesabilitadas; ?>">
        </form>
    </div>
</body>
</html>