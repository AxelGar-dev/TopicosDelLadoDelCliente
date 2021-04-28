<?php
$datos = "";
$nombreAModiicar = "";
$direccionAModificar = "";
if(isset($_POST['modificar'])) {
    if(strrpos($_POST['datosGuardados'], $_POST['nombreAModificar']) === 0) {
        $nombreAModificar = $_POST['nombreAModificar'];
        $direccionAModificar = $_POST['direccionAModificar'];
        $datos = substr($_POST['datosGuardados'], strlen($nombreAModificar) + strlen($direccionAModificar) + 2);
    }
    else {
        $nombreAModificar = $_POST['nombreAModificar'];
        $direccionAModificar = $_POST['direccionAModificar'];
        $datos = substr($_POST['datosGuardados'], 0, strrpos($_POST['datosGuardados'], $_POST['nombreAModificar'])) . substr($_POST['datosGuardados'], strrpos($_POST['datosGuardados'], $_POST['nombreAModificar']) + (strlen($direccionAModificar) + strlen($nombreAModificar) + 2));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 8</title>
</head>
<body>
    <form action="U2_Practica7.php" method="POST">
        <input type="hidden" name="datosGuardados" value="<?php echo $datos; ?>" style="border: 1px solid #2F2381;">
        <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombreAModificar;?>" readonly>
        <input type="text" name="direccion" id="" placeholder="Direccion" value="<?php echo $direccionAModificar;?>" readonly><br>
        <label for="">Nuevo nombre</label>
        <input type="text" name="nuevoNombre" placeholder="Escribe el nuevo nombre" required>
        <label for="">Nueva dirección</label>
        <input type="text" name="nuevaDireccion" placeholder="Escribe la nueva dirección" required>
        <input type="text" value="1" hidden name="bandera8">
        <input type="submit" value="Modificar" name="btnEnviar">
    </form>
    <form action="U2_Practica7.php" method="POST">
        <input type="hidden" name="datosGuardados" value="<?php echo $datos; ?>" style="border: 1px solid #2F2381;">
        <input type="hidden" name="nombre" placeholder="Nombre" value="<?php echo $nombreAModificar;?>">
        <input type="hidden" name="direccion" id="" placeholder="Direccion" value="<?php echo $direccionAModificar;?>">
        <input type="text" value="1" hidden name="bandera9">
        <input type="submit" value="Regresar sin modificar" name="btnEnviar">
    </form>
</body>
</html>