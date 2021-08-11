<?php
    require_once "../includes/conectaBD.php";

    $sql = "CREATE TABLE categoria (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(200) NOT NULL
    )";

$result = mysqli_query($con, $sql);

if(!$result){
    die("Erro ao criar a tabela de categoria ".mysqli_error($con));
}else{
    echo "<h2>Tabela categoria criado com sucesso!</h2>";
}