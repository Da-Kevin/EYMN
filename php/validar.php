<?php  
$email=$_POST['Email'];
$contraseña= md5($_POST['Clave']);
session_start();
$_SESSION['Email']=$email;

$conn = mysqli_connect('localhost', 'root', '', 'eymn');

$consulta="SELECT*FROM persona where Correo_electrónico='$email' and Clave='$contraseña'";
$resultado=mysqli_query($conn,$consulta);

$filas=mysqli_fetch_array($resultado);

error_reporting(E_ERROR | E_PARSE);

//admin
if($filas['ID_Cargo']==1){
    header("location:../php/crud.php");
}elseif($filas['ID_Cargo']==2){
    header("location:../html/paginadeinicio.html");
}else{
    ?>
    <?php
    include("../html/INICIAR SESION2.HTML");
    ?>
    <?php
}
mysqli_free_result($resultado);
mysqli_close($conn);