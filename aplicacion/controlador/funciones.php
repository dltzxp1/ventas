<?php
require_once("../modelo/dao/usuario.php");
function conexiones($email, $pass) {
    $objUsuario = new usuario('0');
    $arrUser = $objUsuario->arregloUsuario;
    for ($i = 0; $i < count($arrUser); $i++) {
        if ($arrUser[$i]->us_mail == $email && $arrUser[$i]->us_clave == md5(trim($pass)) && $arrUser[$i]->us_estado == "ACT") {
            $emailDB = $arrUser[$i]->us_mail;
            session_start();
            $_SESSION["usMail"] = $arrUser[$i]->us_mail;
            $_SESSION["usClave"] = $arrUser[$i]->us_clave;
            $_SESSION["usUsuario"] = $arrUser[$i]->us_nombre;
            $_SESSION["usId"] = $arrUser[$i]->us_id;
        }
    }
    if ($email == $emailDB) {
        return true;
    } else {
        return false;
    }
}
function verificar_usuario() {
    session_start();
    if ($_SESSION["usMail"]) {
        return true;
    }
}
?>