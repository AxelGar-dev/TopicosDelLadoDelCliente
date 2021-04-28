<?php
$mensaje = "";
$cad = "";
if(isset($_POST['generar'])) {
    for($r = 1; $r <= $_POST['row']; $r++) {
        $cad .= "<tr>";
        for($c = 1; $c <= $_POST['col']; $c++) {
            $cad .= "
                <td>
                    <form action='' method='POST'>
                        <input type='hidden' value='".$_POST["row"]."' name='row'>
                        <input type='hidden' value='".$_POST["col"]."' name='col'>
                        <input type='hidden' value='1' name='generar'>
                        <input type='submit' name='btnDentro' value='$r-$c'>
                    </form>
                </td>";
        }
        $cad .= "</tr>";
    }
    if(isset($_POST["btnDentro"])) {
        $mensaje = "<div style='border: 1px solid #6C8387; width: 20%; margin: 5px auto'>Usted presionó el botón: $_POST[btnDentro]</div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
    <form action="" method="POST">
        <input type="number" placeholder="Ingresa el número de filas" step="1" min="1" name="row">
        <input type="number" placeholder="Ingresa el número de columnas" step="1" min="1" name="col">
        <input type="submit" name="generar">
    </form>
    <table border="1">
        <?php echo $cad; ?>
    </table>
    <?php echo $mensaje; ?>
</body>
</html>