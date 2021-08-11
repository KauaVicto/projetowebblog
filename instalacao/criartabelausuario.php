<?php
    require_once "../includes/conectaBD.php";

    $sql = "CREATE TABLE usuario (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(150),
        login VARCHAR(100) NOT NULL,
        senha VARCHAR(100) NOT NULL
    )";

$result = mysqli_query($con, $sql);

if(!$result){
    die("Erro ao criar a tabela de usuário ".mysqli_error($con));
}else{
    echo "<h2>Tabela usuário criado com sucesso!</h2>";
}