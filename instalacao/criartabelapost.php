<?php
    require_once "../includes/conectaBD.php";

    $sql = "CREATE TABLE post (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(200),
        conteudo TEXT,
        imagem VARCHAR(200),
        id_usuario INT,
        FOREIGN KEY (id_usuario) REFERENCES usuario(id)
    )";

$result = mysqli_query($con, $sql);

if(!$result){
    die("Erro ao criar a tabela de categoria ".mysqli_error($con));
}else{
    echo "<h2>Tabela categoria criado com sucesso!</h2>";
}