<?php
$resultado = "";
if(isset($_POST['operacion'])) {
    switch($_POST['operacion']) {
        case '1':
            $resultado = "El resultado de la suma es: ". $_POST["n1"] + $_POST["n2"];
            break;
        case '2':
            $resultado = "El resultado de la resta es: ". $_POST["n1"] - $_POST["n2"];
            break;
        case '3':
            $resultado = "El resultado de la multiplicación es: ". $_POST["n1"] * $_POST["n2"];
            break;
        case '4':
            $resultado = "El resultado de la división es: ". $_POST["n1"] / $_POST["n2"];
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operaciones</title>
</head>
<body>
    <form action="" method="POST" name="formulario">
        <input type="number" name="n1" placeholder="Ingresa el primer número">
        <select name="operacion" onchange="formulario.submit();" id="">
            <option value="">--- Seleccione ---</option>
            <option value="1" name="+">+</option>
            <option value="2">-</option>
            <option value="3">*</option>
            <option value="4">/</option>
        </select>
        <input type="number" name="n2" placeholder="Ingresa el segundo número">
    </form>
    <?php echo $resultado; ?>
</body>
</html>