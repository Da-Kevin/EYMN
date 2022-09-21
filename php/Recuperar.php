<?php
$email=$_POST['email'];
$contraseña= $_POST['contraseña'];
session_start();
$_SESSION['email']=$email;

$conn = mysqli_connect('localhost', 'root', '', 'eymn');

$verificacion="SELECT * FROM persona WHERE Correo_electrónico='$email'";

$validacion=mysqli_query($conn,$verificacion);

$filas=mysqli_num_rows($validacion);

if(!$filas){
    echo "<script>alert('No se ha encontrado el correo electronico, verifiquelo nuevamente')</script>";
    include("../html/clave.html");
}else{ 
    echo "<script>alert('Se actualizo su contraseña correctamente')</script>";
    $consulta= "UPDATE persona SET Clave='$contraseña' where Correo_electrónico='$email'";
    $resultado=mysqli_query($conn,$consulta);
    include ("../html/corecto.html");
}

mysqli_close($conn);
?>
