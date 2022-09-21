<?php

if (!empty($_POST["btnregistrar"])){
    if (!empty($_POST["tipo"]) and !empty($_POST["producto"]) and !empty($_POST["marca"]) and !empty($_POST["precio"]) and !empty($_POST["descripcion"]) and !empty($_POST["imagen"]) and !empty($_POST["estado"])) {

        $tipo=$_POST["tipo"];
        $nombre=$_POST["producto"];
        $marca=$_POST["marca"];
        $precio=$_POST["precio"];
        $descripcion=$_POST["descripcion"];
        $imagen=$_POST["imagen"];
        $activo=$_POST["estado"];

        $sql=$conexion->query(" insert into productos(Tipo,Nombre,Marca,Precio,Descuento,Descripcion,Imagen,activo)values('$tipo','$nombre','$marca','$precio','0','$descripcion','$imagen','$activo') ");
        if ($sql==1){
            echo '<div class="alert alert-success">Producto registrada correctamente</div>';
        }else{
            echo '<div class="alert alert-danger">Error al registrar producto</div>';
        }

    }else{
        echo '<div class="alert alert-warning">Alguno de los campos se encuentra vacío</div>';  
    }
}

?>