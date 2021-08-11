<?php
    require_once "includes/conectaBD.php";
    require_once "protegido.php";
    include_once "topo.php"; 
    include_once "menu.php"; 
?>

<h1>Seja Bem-vindo <?=$_SESSION["usuario"]?></h1>

<?php include_once "rodape.php"; ?>