<?php

/* md5 -> é uma função que gera uma string encriptada */

require_once "../includes/conectaBD.php";

$nome = "Admin";
$login = "admin";
$senha = sha1("12345");

$sql = "INSERT INTO usuario(nome, login, senha) VALUES ('$nome', '$login', '$senha')";

$result = mysqli_query($con, $sql);

if(!$result){
    die("Erro ao salvar o usuário padrão no banco. ".mysqli_error($con));
}else{
    echo "<h1>Usuário padrão cadastrado com sucesso!</h1>";
}