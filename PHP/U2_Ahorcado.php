<?php
$palabras = array("Cascada", "Carrera", "Gran persona", "Laberinto", "Cama");
$niveles = count($palabras);
$letras = "";
$style = "";
$imagen = "";
$nivel = 0;
$teclado = "";
$teclasDesabilitadas = "";
$valorCampo = "";
$opcionCorrecta = 0;
$siguienteNivel = "";
$errores = 0;
$nivelesPerdidos = 0;
$nivelesGanados = 0;
$volverAJugar = "";
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

if(isset($_POST['next'])) {
    $siguienteNivel = "";
    $nivel = $_POST['nivel'];
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
    $nivelesGanados = $_POST['ganado'];
    $nivelesPerdidos = $_POST['perdido'];
}

if(isset($_POST['btnLetra'])) {
    $style = "display: none;";
    $teclasDesabilitadas = $_POST['teclas'];
    $valorCampo = $_POST['valor'];
    $opcionCorrecta = $_POST['aciertos'];
    $nivel = $_POST['nivel'];
    $errores = $_POST['errores'];
    $imagen = $_POST['ahorcado'];
    $nivelesGanados = $_POST['ganado'];
    $nivelesPerdidos = $_POST['perdido'];
    if(comprobarCaracter($_POST['btnLetra'], $_POST['nivel'])) {
        if($opcionCorrecta == strlen(str_replace(" ", "", $palabras[$nivel]))) {
            $nivel++;
            if($nivel == count($palabras)) {
                $volverAJugar = <<<HDOC
                        <form action='' method='POST' name='finDelJuego'>
                            <p>Niveles ganados: $nivelesGanados</p>
                            <p>Niveles perdidos: $nivelesPerdidos</p>
                            <input type='submit' name='start' value='Volver a jugar' class='playAgain'>
                        </form>
                HDOC;
            }
            else {
                $siguienteNivel = "<input type='submit' value='Siguiente nivel' name='next' class='siguiente'>";
                $nivelesGanados++;
                inhabilitarTeclado();
            }
        }
    }
    else {
        $errores++;
        switch($errores) {
            case 1:
                $imagen = "../images/Ahorcado.png";
                break;
            case 2:
                $imagen = "../images/Ahorcado-1.png";
                break;
            case 3:
                $imagen = "../images/Ahorcado-2.png";
                break;
            case 4:
                $imagen = "../images/Ahorcado-3.png";
                break;
            case 5:
                $imagen = "../images/Ahorcado-4.png";
                break;
            case 6:
                $imagen = "../images/Ahorcado-5.png";
                inhabilitarTeclado();
                $nivel++;
                if($nivel == count($palabras)) {
                    $volverAJugar = <<<HDOC
                        <form action='' method='POST' name='finDelJuego'>
                            <p>Niveles ganados: $nivelesGanados</p>
                            <p>Niveles perdidos: $nivelesPerdidos</p>
                            <input type='submit' name='start' value='Volver a jugar' class='playAgain'>
                        </form>
                    HDOC;
                }
                else {
                    $siguienteNivel = "<input type='submit' value='Siguiente nivel' name='next' class='siguiente'>";
                    $nivelesPerdidos++;
                }
                break;
        }
    }
}

function crearTeclado($teclaPresionada) {
    global $teclado;
    global $teclasDesabilitadas;
    if($teclasDesabilitadas != "") {
        $arrayTeclas = explode("-", $teclasDesabilitadas);
        sort($arrayTeclas);
        $j = 0;
        for($i = 65; $i <= 90; $i++) {
            $letter = chr($i);
            if($j < count($arrayTeclas)) {
                if($arrayTeclas[$j] == $letter) {
                    $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='disabled' disabled>";
                    $j++;
                }
                elseif($letter == $teclaPresionada) {
                    $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='disabled' disabled>";
                    $teclasDesabilitadas .= "-". $letter;
                }
                else {
                    $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='enabled' enabled>";
                }
            }
            elseif($letter == $teclaPresionada) {
                $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='disabled' disabled>";
                $teclasDesabilitadas .= "-". $letter;
            }
            else {
                $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='enabled' enabled>";
            }
        }
    }
    else {
        for($i=65; $i<=90; $i++) {
            $letter = chr($i);
            if($letter == $teclaPresionada) {
                $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='disabled' disabled>";
                $teclasDesabilitadas .= $letter;
            }
            else {
                $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='enabled' enabled>";
            }
        }
    }
}

function comprobarCaracter($teclaPresionada, $nivelActual) {
    global $valorCampo;
    global $palabras;
    global $letras;
    global $opcionCorrecta;
    $cadena = $palabras[$nivelActual];
    $banderaTecla = 0;
    if($valorCampo != "") {
        $arrayCaracteres = explode("-", $valorCampo);
        for($i = 0; $i < strlen($cadena); $i++) {
            if($cadena[$i] == " ") {
                $letras .= "<p style='margin-left: 20px; margin-right: 20px;'></p>";
            }
            elseif(strcasecmp($cadena[$i], $teclaPresionada) == 0) {
                $letras .= "<input type='text' value='$teclaPresionada' autocomplete='off' class='lyrics' id='$i' readonly style='margin-right: 5px;'>";
                $opcionCorrecta++;
                if(!str_contains($valorCampo, $teclaPresionada)) {
                    $valorCampo .= "-" .$teclaPresionada;
                    $banderaTecla = 1;
                }
            }
            else {
                $flag = 0;
                for($j = 0; $j < count($arrayCaracteres); $j++) {
                    if(strcasecmp($arrayCaracteres[$j], $cadena[$i]) == 0) {
                        $letras .= "<input type='text' value='$arrayCaracteres[$j]' autocomplete='off' class='lyrics' id='$i' readonly style='margin-right: 5px;'>";
                        $flag = 1;
                        break;
                    }
                }
                if(!$flag) {
                    $letras .= "<input type='text' autocomplete='off' class='lyrics' id='$i' readonly style='margin-right: 5px;'>";
                }
            }
        }
    }
    else {
        for($i = 0; $i < strlen($cadena); $i++) {
            if($cadena[$i] == " ") {
                $letras .= "<p style='margin-left: 20px; margin-right: 20px;'></p>";
            }
            elseif(strcasecmp($cadena[$i], $teclaPresionada) == 0) {
                $letras .= "<input type='text' value='$teclaPresionada' autocomplete='off' class='lyrics' id='$i' readonly style='margin-right: 5px;'>";
                $opcionCorrecta++;
                if(!str_contains($valorCampo, $teclaPresionada)) {
                    $valorCampo .= $teclaPresionada;
                    $banderaTecla = 1;
                }
            }
            else {
                $letras .= "<input type='text' autocomplete='off' class='lyrics' id='$i' readonly style='margin-right: 5px;'>";
            }
        }
    }
    crearTeclado($teclaPresionada);
    return $banderaTecla;
}

function inhabilitarTeclado() {
    global $teclado;
    $teclado = "";
    for($i=65; $i<=90; $i++) {
        $letter = chr($i);
        $teclado .= "<input type='submit' value='$letter' name='btnLetra' onchange='miFormulario.submit();' class='disabled' disabled>";
    }
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

        .nextLevel {
            text-align: center;
            margin-top: 50px;
        }

        .nextLevel form .siguiente {
            width: 30%;
            height: 40px;
            font-size: 16px;
            font-weight: bold;
            border: 1px solid #2b2;
            background-color: #2b2;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
        }

        .gameOver {
            text-align: center;
            margin-top: 50px;
        }

        .gameOver p {
            font-size: 16px;
            font-weight: 500;
        }

        .gameOver .playAgain {
            width: 30%;
            height: 40px;
            font-size: 16px;
            font-weight: bold;
            border: 1px solid #2b2;
            background-color: #2b2;
            color: #fff;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="instructions">
        <h1>Ahorcado</h1>
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
            <input type="hidden" name="nivel" value="<?php echo $nivel?>">
            <input type="hidden" name="valor" value="<?php echo $valorCampo; ?>">
            <input type="hidden" name="teclas" value="<?php echo $teclasDesabilitadas; ?>">
            <input type="hidden" name="aciertos" value="<?php echo $opcionCorrecta; ?>">
            <input type="hidden" name="errores" value="<?php echo $errores; ?>">
            <input type="hidden" name="ahorcado" value="<?php echo $imagen; ?>">
            <input type="hidden" name="perdido" value="<?php echo $nivelesPerdidos?>">
            <input type="hidden" name="ganado" value="<?php echo $nivelesGanados?>">
            <?php echo $teclado; ?>
        </form>
    </div>
    <div class="nextLevel">
        <form action="" method="POST" name="siguienteNivel">
            <input type="hidden" name="nivel" value="<?php echo $nivel?>">
            <input type="hidden" name="perdido" value="<?php echo $nivelesPerdidos?>">
            <input type="hidden" name="ganado" value="<?php echo $nivelesGanados?>">
            <?php echo $siguienteNivel; ?>
        </form>
    </div>
    <div class="gameOver">
        <?php echo $volverAJugar; ?>
    </div>
</body>
</html>