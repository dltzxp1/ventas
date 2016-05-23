<?php

include ('funciones.php');
if (verificar_usuario()) {
    //si el usuario es verificado, se elimina los valores,se destruye la sesion y volvemos al formulario de ingreso
    unset($_SESSION["usMail"]);
    unset($_SESSION["usClave"]);
    unset($_SESSION["usUsuario"]);
    unset($_SESSION["usId"]);


    session_unset();
    session_destroy();
    header('Location: ../../index.php');
} else {
    //si el usuario no es verificado vuelve al formulario de ingreso
    header('Location: ../../index.php');
}
?>
