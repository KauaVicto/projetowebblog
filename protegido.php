<?php
    if(!isset($_SESSION["logado"])){
        $_SESSION["erro"] = "Usuário não está logado no sistema.";
        header("location: login.php");
    }
?>