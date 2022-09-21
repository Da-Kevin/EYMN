<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/646ac4fad6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../estilos/estilos-pginicio.css">
    <link rel="stylesheet" href="../estilos/estilo_crud.css">
</head>
<header>
        <div class="collapse" id="navbarHeader">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 col-md-7 py-4">
                <h4 class="text-black">Sobre Nosotros</h4>
                <p class="text-muted">EYMN es una plataforma de compra y venta de productos, actualmente contamos con la sección de moda, las demás estarán disponibles pronto al igual que la posibilidad de vender sus propios productos.</p>
                <ul class="list-unstyled">
                    <li><a href="../html/nosotros.html" class="text-black">Más información</a></li>
                </ul>
              </div>
              <div class="col-sm-4 offset-md-1 py-4">
                <h4 class="text-black">Comience Ahora</h4>
                <ul class="list-unstyled">
                    <li><a href="crud.php" class="text-black">Persona</a></li>
                    <li><a href="../INDEX.HTML" class="text-black">Cerrar Sesión</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="navbar">
          <div class="container">
            <a href="../INDEX.HTML" class="navbar-brand">
              <h2 class="font">EYMN</h2>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
        </div>
      </header>
<body>


    <script>
        
        function eliminar(){
            var respuesta=confirm("¿Estas seguro que deseas eliminar?")
            return respuesta
        }

    </script>
    <h1 class="text-center p-3">Historial de registro</h1>
    <?php 
    include "conexion_crud.php";
    include "eliminar_producto.php";

    ?>
    <div class="container-fluid row">
        <form class="col-4 p-3" method="POST">
            <h3 class="text-center text-secondary">Registros por el Administrador</h3>
            <?php
            include "conexion_crud.php";
            include "registro_producto.php";
            ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tipo</label>
                <input type="text" class="form-control" name="tipo">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                <input type="text" class="form-control" name="producto">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Marca</label>
                <input type="text" class="form-control" name="marca">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Precio</label>
                <input type="text" class="form-control" name="precio">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion">
            </div> 
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Imagen</label>
                <input type="text" class="form-control" name="imagen">
            </div> 
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Activo</label>
                <input type="text" class="form-control" name="estado">
            </div> 
            <button type="submit" class="btn btn-primary" name="btnregistrar" value="Ok">Registrar</button>
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead class="barra">
                    <tr>
                        <th scope="col">ID_Pr</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Activo</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "conexion_crud.php";
                    $sql = $conexion->query("select * from productos");
                    while ($datos= $sql->fetch_object()) { ?>
                        <tr>
                            <td><?= $datos->ID_Pr?></td>
                            <td><?= $datos->Tipo?></td>
                            <td><?= $datos->Nombre?></td>
                            <td><?= $datos->Marca?></td>
                            <td><?= $datos->Precio?></td>
                            <td><?= $datos->Descuento?></td>
                            <td><?= $datos->Descripcion?></td>
                            <td><?= $datos->Imagen?></td>
                            <td><?= $datos->activo?></td>
                            <td>
                                <a href="modificar_producto.php?ID_Pr=<?= $datos->ID_Pr ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a onclick="return eliminar()" href="crud_productos.php?ID_Pr=<?= $datos->ID_Pr ?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php  }
                    ?> 
                </tbody>
            </table>
        </div>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>