<?php
$datosRetorno = "";
$datos = "";
if(isset($_POST['delete'])) {
    if(strrpos($_POST['datosGuardados'], $_POST['nombreAEliminar']) === 0) {
        $nombreAEliminar = $_POST['nombreAEliminar'];
        $direccionAeliminar = $_POST['direccionAEliminar'];
        $_POST['datosGuardados'] = substr($_POST['datosGuardados'], strlen($nombreAEliminar) + strlen($direccionAeliminar) + 2);
    }
    else {
        $nombreAEliminar = $_POST['nombreAEliminar'];
        $direccionAEliminar = $_POST['direccionAEliminar'];
        $_POST['datosGuardados'] = substr($_POST['datosGuardados'], 0, strrpos($_POST['datosGuardados'], $_POST['nombreAEliminar'])) . substr($_POST['datosGuardados'], strrpos($_POST['datosGuardados'], $_POST['nombreAEliminar']) + (strlen($direccionAEliminar) + strlen($nombreAEliminar) + 2));
    }
}
if(isset($_POST['btnEnviar'])) {
    if(isset($_POST['bandera8'])) {
        $_POST['datosGuardados'] = $_POST['nuevoNombre'] . ",". $_POST['nuevaDireccion'] ."@" . $_POST['datosGuardados'];
    }
    if(isset($_POST['bandera9'])) {
        $_POST['datosGuardados'] = $_POST['nombre'] . ",". $_POST['direccion'] ."@" . $_POST['datosGuardados'];
    }
    $cadenaAUsar = "";
    if(substr($_POST['datosGuardados'], strlen($_POST['datosGuardados']) - 1) == "@") {
        $cadenaAUsar = substr($_POST['datosGuardados'], 0, strlen($_POST['datosGuardados']) - 1);
    }

    if($_POST['datosGuardados'] !== "") {
        $datosRetorno =  $_POST['datosGuardados'];
        $registros = explode("@", $cadenaAUsar);
        for($i = 0; $i < count($registros); $i++) {
            $datosPersonales = explode(",", $registros[$i]);
            $datos .= <<<HDOC
                <tr id="$i">
                    <td>$datosPersonales[0]</td>
                    <td>$datosPersonales[1]</td>
                    <td>
                        <form action="U2_Practica8.php" method="POST">
                            <input type='hidden' value="$datosRetorno" name='datosGuardados'>
                            <input type='hidden' value="$datosPersonales[0]" name='nombreAModificar'>
                            <input type='hidden' value="$datosPersonales[1]" name='direccionAModificar'>
                            <input type="submit" value="Modificar" name="modificar">
                        </form>
                    </td>
                    <td>
                        <form action="" method="POST">
                            <input type='hidden' value="$datosRetorno" name='datosGuardados'>
                            <input type='hidden' value="$datosPersonales[0]" name='nombreAEliminar'>
                            <input type='hidden' value="$datosPersonales[1]" name='direccionAEliminar'>
                            <input type='hidden' value="1" name='btnEnviar'>
                            <input type="submit" value="Eliminar" name="delete">
                        </form>
                    </td>
                    <td>
                        <form action="" method="POST">
                            <input type='hidden' value="$datosRetorno" name='datosGuardados'>
                            <input type='hidden' value="$datosPersonales[0]" name='nombreAEliminar'>
                            <input type='hidden' value="$datosPersonales[1]" name='direccionAEliminar'>
                            <input type='hidden' value="1" name='btnEnviar'>
                            <input type="submit" value="Detalles" name="detalle">
                        </form>
                    </td>
                </tr>
            HDOC;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 7</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $datos?>
        </tbody>
    </table>
    <form action="U2_Practica6.php" method="POST">
        <input type="hidden" name="datosRetorno" value="<?php echo $datosRetorno; ?>">
        <input type="submit" value="Regresar" name="btnRegresar">
    </form>
</body>
</html>