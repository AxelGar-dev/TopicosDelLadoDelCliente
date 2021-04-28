<?PHP
$contador = 0;
$renglonPrincipal = "";
$renglon2Css = "";
$renglon3Css = "";
$renglon4Css = "";
$reglon1Block = "";
$reglon2Block = "";
$renglon3Block = "";
$renglon4Block = "";
$nombre = "";
$direccion = "";
$telefono  = "";
$correo = "";
$mensaje = "";
$ciudad = "";
$carrera = "";
$statusCdmx="";
$statusMor="";
$statusZita="";
$statusSelect="";
$carrera="";


/* determina si una variable existe */
if (isset($_GET['contador'])) {
    #echo "Existe";
    $contador = $_GET['contador'] + 1;

    switch ($contador) {
        case '2':
            $renglon2Css = "";
            if ($_GET['nombre'] != "" && $_GET['direccion'] != "") {
                $reglon1Block = "readonly";
                $nombre = $_GET['nombre'];
                $direccion =  $_GET['direccion'];

            } else {
                $renglon2Css = "display:none";
                $contador = 1;
                $mensaje = "No seas tramposo y llena bien los datos";
            }
            $renglon3Css = "display:none;";
            $renglon4Css = "display:none;";
            break;
        case '3':
            $renglon2Css = "";
            $reglon1Block = "readonly";
            $nombre = $_GET['nombre'];
            $direccion =  $_GET['direccion'];
            if ($_GET['telefono'] != "" &&  $_GET['correo'] != "") {
                $reglon2Block = "readonly";
                $renglon2Css = "";
                $telefono = $_GET['telefono'];
                $correo = $_GET['correo'];
                $renglon3Css = "";
            }else{
                $contador = 2;
                $renglon3Css = "display:none";
            }
            $renglon4Css = "display:none;";
            break;
        case '4':
            $renglon2Css = "";
            $renglon3Css = "";
            $renglon4Css = "";
            $reglon1Block = "readonly";
            $reglon2Block = "readonly";
            $nombre = $_GET['nombre'];
            $direccion =  $_GET['direccion'];
            $telefono = $_GET['telefono'];
            $correo = $_GET['correo'];
            if($_GET["ciudad"]!=""){
                $ciudad = $_GET["ciudad"];
                $renglon3Block = "disabled";
                $statusSelect = "disabled";
                if($_GET["ciudad"]=="ZITACUARO"){
                    $statusZita="selected";
                    $statusMor="disabled";
                    $statusCdmx="disabled";
                }else if($_GET["ciudad"]=="MORELIA"){
                    $statusZita="selected";
                    $statusMor="disabled";
                    $statusCdmx="disabled";

                }else if($_GET["ciudad"]=="CDMX"){
                    $statusCdmx="selected";
                    $statusMor="disabled";
                    $statusZita="disabled";

                }
            }else{
                $renglon4Css = "display:none";
                $statusCdmx="";
                $statusMor="";
                $statusZita="";
                $statusSelect="selected";
                $mensaje = "No seas tramposo y selecciona un dato";
                $contador = 3;
            }
        break;
        case '5':
            $renglon2Css = "";
            $renglon3Css = "";
            $renglon4Css = "";
            $reglon1Block = "readOnly";
            $reglon2Block = "readOnly";
            $reglon3Block = "readOnly";
            $nombre = $_GET['nombre'];
            $direccion =  $_GET['direccion'];
            $telefono = $_GET['telefono'];
            $correo = $_GET['correo'];
            if($_GET["ciudad"]=="ZITACUARO"){
                $statusZita="disabled";
                $statusMor="selected";
                $statusCdmx="disabled";
            }else if($_GET["ciudad"]=="MORELIA"){
                $statusZita="disabled";
                $statusMor="selected";
                $statusCdmx="disabled";

            }else if($_GET["ciudad"]=="CDMX"){
                $statusCdmx="selected";
                $statusMor="disabled";
                $statusZita="disabled";

            }
            if($_GET["carrera"]!=""){
                $carrera = $_GET["carrera"];
                $renglon4Block = "readOnly";
            }else{
                $contador=4;
                $mensaje = "No seas tramposo y llena la carrera";
            }

        break;
        case '6':
            $reglon1Block = "readonly";
            $reglon2Block = "readonly";
            $reglon3Block = "readonly";
            $reglon4Block = "readonly";
            $renglonPrincipal = "display:none;";
            $elementos = "<div>";
            foreach ($_GET as $key => $value) { 
                echo $key."  -->  ".$value."<br>";
            }
            echo "<br><br><br>";
            echo "<a href='http://localhost/TopicosDeProgramacionDelLadoDelServidor/src/PHP/practica3.php'>Comenzar de nuevo</a>";
            
        break;
        default:
            $nombre = $_GET['nombre'];
            $direccion =  $_GET['direccion'];
            $reglon2Block = "readonly";
            $renglon2Css = "";
            $telefono = $_GET['telefono'];
            $correo = $_GET['correo'];
            $contador -= 1;
            break;
    }

} else {
    $contador = 1;
    $renglon2Css = "display:none;";
    $renglon3Css = "display:none;";
    $renglon4Css = "display:none;";
    /* echo "No existe"; */
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 3</title>

    <style>
        div {
            margin-top: 2%;
            border: 1px solid blue;
        }
    </style>
</head>

<body>


    <form action="" method="GET" style="<?php echo $renglonPrincipal?>">

        <input type="hidden" name="contador" value="<?PHP echo $contador; ?>">
        <div>
            Nombre: <input type="text" name="nombre" id="" value="<?PHP echo $nombre; ?>" require <?PHP echo $reglon1Block; ?> /> <br />
            Direccion: <input type="text" name="direccion" value="<?PHP echo $direccion; ?>" id="" require <?PHP echo $reglon1Block; ?> />
        </div>
        <div style=" <?php echo $renglon2Css; ?> ">
            Telefono: <input type="tel" name="telefono" id="" value="<?PHP echo $telefono; ?>" <?PHP echo $reglon2Block; ?> /> <br />
            Correo: <input type="email" name="correo" id="" value="<?PHP echo $correo; ?>" <?PHP echo $reglon2Block; ?> />
        </div>
        <div  style=" <?php echo $renglon3Css; ?> ">
            Ciudad: <select name="ciudad" id="" <?php $renglon3Block?>>
                <option value="" <?php echo $statusSelect?>>Seleccione</option>
                <option value="ZITACUARO" <?php echo $statusZita?>>Zitácuaro</option>
                <option value="MORELIA" <?php echo $statusMor?>>Morelia</option>
                <option value="CDMX" <?php echo $statusCdmx?>>CDMX</option>
            </select>
        </div>

        <div  style=" <?php echo $renglon4Css; ?> ">
            Carrera: <input type="text" name="carrera" id="" value="<?php echo $carrera;?>" <?php echo $renglon4Block;?>/>
        </div>
        <input type="submit" value="Enviar<?PHP echo $contador; ?>" />
    </form>

    <?PHP echo $mensaje; ?>

</body>

</html>