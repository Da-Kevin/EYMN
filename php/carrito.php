<?php


require 'config.php';

if(isset($_POST['ID_Pr'])) {

    $ID_Pr = $_POST['ID_Pr'];
    $token = $_POST['token'];

    $token_tmp = hash_hmac('sha1', $ID_Pr, KEY_TOKEN);

    if ($token == $token_tmp) {

        if(isset($_SESSION['carrito']['productos'][$ID_Pr])) {
            $_SESSION['carrito']['productos'][$ID_Pr] += 1;
        } else {
            $_SESSION['carrito']['productos'][$ID_Pr] = 1;
        }

        $datos['numero'] = count($_SESSION['carrito']['productos']);
        $datos['ok'] = true;

    } else {
        $datos['ok'] = false;
    }
} else {
    $datos['ok'] = false;
}

echo json_encode($datos);