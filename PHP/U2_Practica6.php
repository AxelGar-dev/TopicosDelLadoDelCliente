<?php
// $porciones = "";
// if(isset($_POST['dato'])) {
//     $porciones = explode(" ", $_POST['dato']);
//     echo "Longitud del otro método: ". count($porciones);
//     echo "<br>";
//     // echo substr($_POST['dato'], $_POST['inicio'], $_POST['tamanio']);
//     echo "<br>";
//     echo "<h2>Otro ejemplo</h2>";
//     for($i = 0; $i < strlen($_POST['dato']); $i++) {
//         echo substr($_POST['dato'], $i, 1);
//         echo "<br>";
//     }
// }

$datos = "";
$nombreAModiicar = "";
$direccionAModificar = "";
if(isset($_POST['btnRegresar'])) {
    $datos = $_POST['datosRetorno'];
}

if(isset($_POST['btnRegistrar'])) {
    $datos = $_POST['nombre'].",". $_POST['direccion']. "@".$_POST['datosGuardados'];
}
//strrpos es como el indexOf
//strlen es como .length
if(isset($_POST['modificar'])) {
    if(strrpos($_POST['datosRetorno'], $_POST['nombreAModificar']) === 0) {
        $nombreAModiicar = $_POST['nombreAModificar'];
        $direccionAModificar = $_POST['direccionAModificar'];
        $datos = substr($_POST['datosRetorno'], strlen($nombreAModiicar) + strlen($direccionAModificar) + 2);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 6</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="datosGuardados" value="<?php echo $datos; ?>" style="border: 1px solid #2F2381;" readonly>
        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombreAModiicar;?>">
        <input type="text" name="direccion" id="" placeholder="Direccion" value="<?php echo $direccionAModificar;?>">
        <input type="submit" value="Registrar nuevo dato" name="btnRegistrar">
    </form>
    <form action="U2_Practica7.php" method="POST">
        <input type="hidden" value="<?php echo $datos; ?>" name="datosGuardados" style="border: 1px solid #2F2381;">
        <input type="submit" value="Ver datos en la tabla" name="btnEnviar">
    </form>
</body>
</html>