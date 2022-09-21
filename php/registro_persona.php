<?php

if (!empty($_POST["btnregistrar"])){
    if (!empty($_POST["nombre"]) and !empty($_POST["fecha"]) and !empty($_POST["correo"]) and !empty($_POST["telefono"]) and !empty($_POST["nombre_de_usuario"]) and !empty($_POST["direccion"]) and !empty($_POST["clave"]) ){

        $nombre=$_POST["nombre"];
        $fecha=$_POST["fecha"];
        $correo=$_POST["correo"];
        $telefono=$_POST["telefono"];
        $nombre_de_usuario=$_POST["nombre_de_usuario"];
        $direccion=$_POST["direccion"];
        $clave=md5($_POST["clave"]);

        $sql=$conexion->query(" insert into persona(Nombre_Real,Edad,Correo_electrónico,Telefono,Nombre_Usuario,Direccion,Clave,ID_Cargo)values('$nombre','$fecha','$correo','$telefono','$nombre_de_usuario','$direccion','$clave', '2') ");
        if ($sql==1){
            echo '<div class="alert alert-success">Persona registrada correctamente</div>';
        }else{
            echo '<div class="alert alert-danger">Error al registrar persona</div>';
        }

    }else{
        echo '<div class="alert alert-warning">Alguno de los campos se encuentra vacío</div>';  
    }
}

?>