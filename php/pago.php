<?php

require 'Conexion.php';
require 'config.php';
$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

$lista_carrito = array();


if($productos != null){

    foreach($productos as $clave => $cantidad) {

        $sql = $con->prepare("SELECT ID_Pr, Nombre, Precio, Descuento, $cantidad AS cantidad FROM productos WHERE 
        ID_Pr=? AND activo=1");
        $sql ->execute([$clave]);
        $lista_carrito[]= $sql->fetch(PDO::FETCH_ASSOC);
    }
} else {
    header("Location: productos.php");
    exit;
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
    <link  rel="stylesheet" type="text/css" href="../estilos/estilos-productos.css">
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
                <div class="col-6">
                    <h4>Detalles de pago</h4>
                    <div id="paypal-button-container"></div>
                </div>

                <div class="col-6">
                    <div class ="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($lista_carrito == null) {
                                    echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
                                } else {

                                    $total = 0;
                                    foreach($lista_carrito as $producto){
                                        $ID_Pr = $producto['ID_Pr'];
                                        $nombre = $producto['Nombre'];
                                        $precio = $producto['Precio'];
                                        $descuento = $producto['Descuento'];
                                        $cantidad = $producto['cantidad'];
                                        $precio_desc = $precio - (($precio * $descuento) / 100);
                                        $subtotal = $cantidad * $precio_desc;
                                        $total += $subtotal;
                                ?>

                                    <tr>
                                        <td><?php echo $nombre; ?></td>
                                        <td>
                                            <div id="subtotal_<?php echo $ID_Pr; ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2, '.', ','); ?></div> 
                                        </td>   
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <td colspan="2">
                                        <p class="h3 text-end" id="total"><?php echo MONEDA . number_format($total, 2, '.', ','); ?> </p>
                                    </td>
                                </tr>    

                            </tbody>
                        <?php }  ?>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" 
crossorigin="anonymous"></script>

<script src="https://www.paypal.com/sdk/js?client-id=<?php echo CLIENT_ID; ?>&currency=<?php echo CURRENCY; ?>"> </script>


<script>
		paypal.Buttons({
			style:{
				color: 'blue',
				shape: 'pill',
				label: 'pay'
			},
			createOrder: function(data,actions){
				return actions.order.create({
					purchase_units: [{
						amount: {
							value: <?php echo $total; ?>
						}
					}]
				});
			},


			onApprove: function(data, actions){
                let url = 'captura.php'
				actions.order.capture().then(function(detalles){
					
                    console.log(detalles);

                    return fetch(url, {
                        method: 'post',
                        headers: {
                            'content-type': 'application/json'
                        },
                        body: JSON.stringify({
                            detalles: detalles
                        })
                    })
				});
                window.location.href="PagoE.html"
			},

			onCancel: function(data){
				alert("Pago cancelado");
				console.log(data);  
			}
	  }).render('#paypal-button-container');
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