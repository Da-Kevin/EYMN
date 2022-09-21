<?php
require 'Conexion.php';
require 'config.php';
$db = new Database();
$con = $db->conectar();


$ID_Pr = isset($_GET['ID_Pr']) ? $_GET['ID_Pr'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($ID_Pr == '' || $token == '') {
  echo 'Error al procesar la petición';
  exit;
} else {
    $token_tmp = hash_hmac('sha1', $ID_Pr, KEY_TOKEN);

    if ($token == $token_tmp) {


      $sql = $con-> prepare("SELECT count(ID_Pr) FROM productos WHERE ID_Pr=? AND activo=1");
      $sql ->execute([$ID_Pr]);
      if ($sql->fetchColumn() > 0) {

        $sql = $con->prepare("SELECT Nombre, Marca, Precio, Descuento, Descripcion, Imagen FROM productos WHERE ID_Pr=? AND activo=1
        LIMIT 1");
        $sql->execute([$ID_Pr]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $nombre = $row['Nombre'];
        $descripcion = $row['Descripcion'];
        $precio = $row['Precio'];
        $descuento = $row['Descuento'];}
        $Imagen = $row['Imagen'];
        $precio_desc = $precio - (($precio * $descuento) / 100);

        $dir_images = '../img/'.$Imagen .'.jpg';

        if(!file_exists($dir_images)) {
          $dir_images = "../img/no-photo.jpg";
        }

      } else {
      echo 'Error al procesar la petición';
      exit; 
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - EYMN</title>
    <link rel="shortcur icon" type="image/x-icon" href="../img/imgpag/LOGO SIN FONDO.png"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
    rel="stylesheet" 
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="../estilos/estilos.css">
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos-detalles.css">
</head>
<body>
     
<header>
  <div class="navbar navbar-expand-lg">
    <div class="container">
        <a href="../html/paginadeinicio.HTML" class="navbar-brand">    
          <h2 class="fuente">EYMN</h2>
        </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
       data-bs-target="#navbarHeader" aria-controls="navbarHeader"
      aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarHeader"> 
        <ul class="navbar-nav me-auto me-2 mb-lg-0">
          <li class="nav-item">
            <a href="../html/paginadeinicio.HTML" class="nav-link active"> Inicio </a>
          </li> 
        </ul> 

        <a href="checkout.php" class="btn"> 
          Carrito <span id="num_cart" class="badge bg-secondary"><?php echo 
          $num_cart; ?> </a>
    </div>
  </div>
</header>

<main>
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-1">
            <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="<?php echo $dir_images; ?>"  class="d-block w-100"> 
                </div>
              </div>
            </div>

        </div>
        <div class="col-md-6 order-md-2">
          <h2><?php echo $nombre; ?></h2>

          <?php if($descuento > 0) { ?>
              <p><del><?php echo MONEDA . number_format($precio, 2, '.', ','); ?></del></p>
              <h2>
                <?php echo MONEDA . number_format($precio_desc, 2, '.', ','); ?>
              <small class="text-success"><?php echo $descuento; ?>% descuento</small>
              </h2>

              <?php } else { ?>

                <h2><?php echo MONEDA . number_format($precio, 2, '.', ','); ?> </h2>

              <?php } ?>

              <p class="lead">
                  <?php echo $descripcion; ?>
              </p>

              <div class="d-grid gap-3 col-10 mx-auto"> 
                  <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $ID_Pr; ?>,
                  '<?php echo $token_tmp; ?>')">Agregar al carrito</button>
              </div>  
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" 
    crossorigin="anonymous"></script>

    <script>
      function addProducto(ID_Pr, token){
        let url= 'carrito.php'
        let formData = new FormData()
        formData.append('ID_Pr', ID_Pr)
        formData.append('token', token)

        fetch(url, {
          method: 'POST',
          body: formData,
          mode: 'cors'
        }).then(response => response.json())
        .then(data => {
            if(data.ok){
              let elemento = document.getElementById("num_cart")
              elemento.innerHTML = data.numero
          }
        })
      }
    </script>
</body>
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h6>About</h6>
                <p class="text-justify">EYMN.com <i>EVERYTHING YOU MAY NEED </i>es una plataforma de compra y venta de productos, actualmente contamos con la sección de moda, las demás estarán disponibles pronto al igual que la posibilidad de vender sus propios productos.</p>
            </div>

            <div class="col-xs-6 col-md-3">
                <h6>CATEGORIAS</h6>
                <ul class="footer-links">
                    <li><a href="../html/DISPONIBLE PRONTO.html">Celulares</a></li>
                    <li><a href="../php/productos.php">Moda</a></li>
                    <li><a href="../html/DISPONIBLE PRONTO.html">Electronicos</a></li>
                    <li><a href="../html/DISPONIBLE PRONTO.html">Electrodomesticos</a></li>
                    <li><a href="../html/DISPONIBLE PRONTO.html">Flores</a></li>
                    <li><a href="../html/DISPONIBLE PRONTO.html">Hogar</a></li>
                    <li><a href="../html/DISPONIBLE PRONTO.html">Juguetes</a></li>
                    <li><a href="../html/DISPONIBLE PRONTO.html">Muebles</a></li>
                    <li><a href="../html/DISPONIBLE PRONTO.html">Accesorios</a></li>
                </ul>
            </div>

            <div class="col-xs-6 col-md-3">
                <h6>Accesos rapidos</h6>
                <ul class="footer-links">
                    <li><a href="../html/nosotros.html">Sobre Nosotros</a></li>
                    <li><a href="../html/Terminos-condiciones.html">Privacidad</a></li>
                </ul>
            </div>
        </div>
        <hr>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <p class="copyright-text">Copyright &copy; 2022 Derechos reservados a
                    <a href="../INDEX.HTML">EYMN</a>.
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="social-icons">
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <script>
            window.watsonAssistantChatOptions = {
              integrationID: "7798c782-9006-4c37-95cb-da1559dd734d", // The ID of this integration.
              region: "us-south", // The region your integration is hosted in.
              serviceInstanceID: "44ed0403-c97a-4a29-a199-96ab28845ee0", // The ID of your service instance.
              onLoad: function(instance) { instance.render(); }
            };
            setTimeout(function(){
              const t=document.createElement('script');
              t.src="https://web-chat.global.assistant.watson.appdomain.cloud/versions/" + (window.watsonAssistantChatOptions.clientVersion || 'latest') + "/WatsonAssistantChatEntry.js";
              document.head.appendChild(t);
            });
          </script>
</footer>
</html>