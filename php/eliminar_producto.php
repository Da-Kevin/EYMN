<?php

if(!empty($_GET["ID_Pr"])) {
    $ID_Pr = $_GET["ID_Pr"];
    $sql=$conexion->query(" delete from productos where ID_Pr=$ID_Pr");
    if($sql == 1) {
        echo "<div class='alert alert-success'> Producto eliminada correctamente </div>";
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar</div>";
    }
}
?>