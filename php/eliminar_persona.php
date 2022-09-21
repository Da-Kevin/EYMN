<?php

if(!empty($_GET["ID_P"])) {
    $ID_P = $_GET["ID_P"];
    $sql=$conexion->query(" delete from persona where ID_P=$ID_P");
    if($sql == 1) {
        echo "<div class='alert alert-success'> Persona eliminada correctamente </div>";
    } else {
        echo "<div class='alert alert-danger'>Error al eliminar</div>";
    }
}
?>