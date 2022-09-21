<?php
include "conexion_crud.php";
$id= $_GET["ID_Pr"];

$sql=$conexion->query("SELECT * FROM productos WHERE ID_Pr = '$id' ");

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
            <input type="hidden" name="ID_Pr" value="<?= $_GET["ID_Pr"]?>">
            <?php
            include "modificar_producto_2.php";
            while ($datos=$sql->fetch_object()) {?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tipo</label>
                    <input type="text" class="form-control" name="tipo" value="<?= $datos->Tipo ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nombre del producto</label>
                    <input type="text" class="form-control" name="producto" value="<?= $datos->Nombre ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Marca</label>
                    <input type="text" class="form-control" name="marca" value="<?= $datos->Marca ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Precio</label>
                    <input type="text" class="form-control" name="precio" value="<?= $datos->Precio ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Descuento</label>
                    <input type="text" class="form-control" name="descuento" value="<?= $datos->Descuento ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Descripcion</label>
                    <input type="text" class="form-control" name="descripcion" value="<?= $datos->Descripcion ?>">
                </div> 
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Imagen</label>
                    <input type="text" class="form-control" name="imagen" value="<?= $datos->Imagen ?>">
                </div> 
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Activo</label>
                    <input  type="text" class="form-control" name="estado" value="<?= $datos->activo ?>">
                </div> 
                
            <?php }
            ?>
            
            <button type="submit" class="btn btn-primary" name="btnregistrar" value="Ok">Modificar</button>
        </form>
</body>
</html>