<?php 

require 'Conexion.php';
require 'config.php';
$db = new Database();
$con = $db->conectar();

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

if(is_array($datos)) {

    $ID_Transaccion = $datos['detalles']['id'];
    $Total = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $Status = $datos['detalles']['status'];
    $Fecha = $datos['detalles']['update_time'];
    $Fecha_nueva = date('Y-m-d H:i:s', strtotime($Fecha));
    $Email = $datos['detalles']['payer']['email_address'];
    $ID_Cliente = $datos['detalles']['payer']['payer_id'];

    $sql = $con->prepare("INSERT INTO compra (ID_Transaccion, Fecha, Status, Email, ID_Cliente, Total) VALUES (?,?,?,?,?,?)");
    $sql->execute([$ID_Transaccion, $Fecha_nueva, $Status, $Email, $ID_Cliente, $Total]);
    $ID_Compra = $con->lastInsertId();

    if($ID_Compra > 0){
        $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

        if($productos != null){
            foreach($productos as $clave => $cantidad) {
        
                $sql = $con->prepare("SELECT ID_Pr, Nombre, Precio, Descuento FROM productos WHERE 
                ID_Pr=? AND activo=1");
                $sql ->execute([$clave]);
                $row_prod = $sql->fetch(PDO::FETCH_ASSOC);

                $precio = $row_prod['Precio'];
                $descuento = $row_prod['Descuento'];
                $precio_desc = $precio - (($precio * $descuento) / 100);

                $sql_insert = $con->prepare("INSERT INTO factura (ID_Compra, ID_Pr, Nombre, Precio, Cantidad) VALUES (?,?,?,?,?)");
                $sql_insert->execute([$ID_Compra, $clave, $row_prod['Nombre'],$precio_desc,$cantidad]);
            }
        } 
        unset($_SESSION['carrito.php']);
    }
}

?>  