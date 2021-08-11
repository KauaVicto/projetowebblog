<?php
    session_start();
    unset($_SESSION["logado"]);
    unset($_SESSION["usuario"]);
    unset($_SESSION["id_usuario"]);

    header("location: login.php");
?>