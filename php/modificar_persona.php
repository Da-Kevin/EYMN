<?php
include "conexion_crud.php";
$id= $_GET["ID_P"];

$sql=$conexion->query("SELECT * FROM persona WHERE ID_P = '$id' ");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificación del registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<body>
<form class="col-4 p-3 m-auto" method="POST">
            <h3 class="text-center text-secondary">Modificar por el Administrador</h3>
            <input type="hidden" name="ID_P" value="<?= $_GET["ID_P"]?>">
            <?php
            include "modificar_persona_2.php";
            while ($datos=$sql->fetch_object()) {?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre de la persona</label>
                    <input type="text" class="form-control" name="nombre" value="<?= $datos->Nombre_Real ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control" name="fecha" value="<?= $datos->Edad ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
                    <input type="mail" class="form-control" name="correo" value="<?= $datos->Correo_electrónico ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Número telefónico</label>
                    <input type="tel" class="form-control" name="telefono" value="<?= $datos->Telefono ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre_Usuario</label>
                    <input type="text" class="form-control" name="nombre_de_usuario" value="<?= $datos->Nombre_Usuario ?>">
                </div> 
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Direccion</label>
                    <input type="text" class="form-control" name="direccion" value="<?= $datos->Direccion ?>">
                </div> 
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                    <input maxlength="50" minlength="8" type="password" class="form-control" name="clave" value="<?= $datos->Clave ?>">
                </div> 
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Cargo</label>
                    <input type="text" class="form-control" name="cargo" value="<?= $datos->ID_Cargo ?>">
                </div> 
                
            <?php }
            ?>
            
            <button type="submit" class="btn btn-primary" name="btnregistrar" value="Ok">Modificar</button>
        </form>
</body>
</html>