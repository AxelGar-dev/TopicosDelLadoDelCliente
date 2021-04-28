<?php
echo "<pre>";
var_dump($_POST);
echo "</pre>";
$URL = "";
$metodo = "";
$datos = "";
if($_POST['id'] != "") {
    $URL = "Practica2b.php";
    $metodo = "GET";
    $datos = "<input type='hidden' name='nombre' value='".$_POST["nombre"]."'>";

    $datos .= "<input type='hidden' name='fecha' value='".$_POST["edad"]."'>";

    $datos .= "<input type='hidden' name='sexo' value='".$_POST["sexo"]."'>";

    $datos .= "<input type='hidden' name='id' value='".$_POST["id"]."'>";

    $datos .= "<input type='email' name='correo' value='' placeholder='correo electrónico'>";
    $datos .= "<input type='text' name='direccion' value='' placeholder='correo dirección'>";
}
if($_POST['pais'] != "") {
    $URL = "Practica2c.php";
    $metodo = "POST";
    $datos = "<select name='pais'>";
    if($_POST["pais"] == "1") {
        $bandera = "selected";
    }
    $datos .= "<option value=''>--- Seleccion ---</option>";
    $datos .= "<option value='Mexico' $bandera>México</option>";
    $datos .= "<option value='Ecuador' $bandera>Ecuador</option>";
    $datos .= "</select>";
}
?>
<form action="<?php echo $URL;?>" method="<?php echo $metodo;?>">
<?php echo $datos; ?>
    <input type="submit">
</form>