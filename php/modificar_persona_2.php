<?php 

if (!empty($_POST["btnregistrar"])) {
    if(!empty($_POST["nombre"]) and !empty($_POST["fecha"]) and !empty($_POST["correo"]) and !empty($_POST["telefono"]) and !empty($_POST["nombre_de_usuario"]) and !empty($_POST["direccion"]) and !empty($_POST["clave"]) and !empty($_POST["cargo"])) {
        $ID_P = $_POST["ID_P"];
        $nombre = $_POST["nombre"];
        $fecha = $_POST["fecha"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $nombre_usuario = $_POST["nombre_de_usuario"];
        $direccion = $_POST["direccion"];
        $clave = md5($_POST["clave"]);
        $cargo = $_POST["cargo"];
        $sql=$conexion->query("update persona set Nombre_Real='$nombre', Edad='$fecha', Correo_electrónico='$correo', Telefono='$telefono', Nombre_Usuario='$nombre_usuario', Direccion='$direccion', Clave='$clave', ID_Cargo='$cargo' where ID_P=$ID_P");
        if($sql == 1) {
            header("location:crud.php");
        } else {
            echo "<div class='alert alert-danger'>Error al modificar</div>";
        }
    }else{
        echo "<div class='alert alert-warning'>Campos Vacíos</div>";
    }
}

?>