<?php
include("../HTML/cabecera.html");
$elemento[0]=$_POST['elemento1'];
$elemento[1]=$_POST['elemento2'];
$suma = $elemento[1] + $elemento[2];
echo $elemento[0] . " + " . $elemento[1] . " = " . $suma;