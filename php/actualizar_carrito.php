<?php 

require 'Conexion.php';
require 'config.php';

if(isset($_POST['action'])){

    $action = $_POST['action'];
    $ID_Pr = isset($_POST['ID_Pr']) ? $_POST['ID_Pr'] : 0;

    if($action == 'agregar') {
        $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
        $respuesta = agregar($ID_Pr, $cantidad);
        if($respuesta >0){
            $datos['ok'] = true;
        } else {
            $datos['ok'] = false;
        }
        $datos['sub'] = MONEDA . number_format($respuesta, 2, '.', ',');
    } else if($action == 'eliminar'){
        $datos['ok'] = eliminar($ID_Pr);
    } else {
        $datos['ok'] = false;
    }
} else {
    $datos['ok'] = false;
}

echo json_encode($datos);

function agregar($ID_Pr, $cantidad){

    $res = 0;
    if($ID_Pr > 0 && $cantidad > 0 && is_numeric(($cantidad))){
        if(isset($_SESSION['carrito']['productos'][$ID_Pr])){
            $_SESSION['carrito']['productos'][$ID_Pr] = $cantidad;

            $db = new Database();
            $con = $db->conectar();

            $sql = $con->prepare("SELECT  Precio, Descuento, Descripcion, Imagen FROM productos WHERE ID_Pr=? AND activo=1
            LIMIT 1");
            $sql->execute([$ID_Pr]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $precio = $row['Precio'];
            $descuento = $row['Descuento'];
            $precio_desc = $precio - (($precio * $descuento) / 100);
            $res = $cantidad * $precio_desc;

            return $res;
        }
    } else {
        return $res;
    }
}

function eliminar($ID_Pr)
{
    if($ID_Pr > 0){
        if(isset($_SESSION['carrito']['productos'][$ID_Pr])) {
            unset($_SESSION['carrito']['productos'][$ID_Pr]);
            return true;
        }
    } else {
        return false;
    }
}