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
                    <li><a href="crud_productos.php" class="text-black">Productos</a></li>
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
    include "eliminar_persona.php";

    ?>
    <div class="container-fluid row">
        <form class="col-4 p-3" method="POST">
            <h3 class="text-center text-secondary">Registros por el Administrador</h3>
            <?php
            include "conexion_crud.php";
            include "registro_persona.php";
            ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre de la persona</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo electrónico</label>
                <input type="mail" class="form-control" name="correo">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Número telefónico</label>
                <input type="tel" class="form-control" name="telefono">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre Usuario</label>
                <input type="text" class="form-control" name="nombre_de_usuario">
            </div> 
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Direccion</label>
                <input type="text" class="form-control" name="direccion">
            </div> 
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Contraseña</label>
                <input maxlength="50" minlength="8" type="password" class="form-control" name="clave">
            </div> 
            <button type="submit" class="btn btn-primary" name="btnregistrar" value="Ok">Registrar</button>
        </form>
        <div class="col-8 p-4">
            <table class="table">
                <thead class="barra">
                    <tr>
                        <th scope="col">ID_P</th>
                        <th scope="col">Nombre real</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Correo electrónico</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Nombre usuario</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">ID_Cargo</th>
                        <th scope="col">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "conexion_crud.php";
                    $sql = $conexion->query("select * from persona");
                    while ($datos= $sql->fetch_object()) { ?>
                        <tr>
                            <td><?= $datos->ID_P?></td>
                            <td><?= $datos->Nombre_Real?></td>
                            <td><?= $datos->Edad?></td>
                            <td><?= $datos->Correo_electrónico?></td>
                            <td><?= $datos->Telefono?></td>
                            <td><?= $datos->Nombre_Usuario?></td>
                            <td><?= $datos->Direccion?></td>
                            <td><?= $datos->ID_Cargo?></td>
                            <td>
                                <a href="modificar_persona.php?ID_P=<?= $datos->ID_P ?>" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a onclick="return eliminar()"href="crud.php?ID_P=<?= $datos->ID_P ?>" class="btn btn-small btn-danger"><i class="fa-solid fa-trash"></i></a>
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