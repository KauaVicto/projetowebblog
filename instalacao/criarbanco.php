<?php

require_once "../includes/config.php";

$con = mysqli_connect(SERVIDOR, USUARIO, SENHA);

if(!$con){
    die("Erro ao conectar no banco ".mysqli_connect_error());
}

$sql = "CREATE DATABASE ".BD;

$result = mysqli_query($con, $sql);

if(!$result){
    die("erro ao criar banco ".mysqli_error($con));
}else{
    echo "<h1>Banco ".BD." Criado com sucesso!</h1>";
}
