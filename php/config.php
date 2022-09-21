<?php

define("CLIENT_ID", "AfjCqC3Be-gzV-0E6fKaCFIiehW8LAqUVTridNgiSIzCRsNIFyzRKrPApD3qs8O_qgRK0lk11nq7iMMb");
define("CURRENCY", "MXN");
define("KEY_TOKEN", "ARP.wqc-354*");
define("MONEDA", "$");

session_start();

$num_cart = 0;

if (isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>