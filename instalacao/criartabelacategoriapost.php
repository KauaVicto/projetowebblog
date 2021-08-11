<?php
    require_once "../includes/conectaBD.php";

    $sql = "CREATE TABLE post_categoria (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_post INT,
        id_categoria INT,
        FOREIGN KEY (id_post) REFERENCES post(id),
        FOREIGN KEY (id_categoria) REFERENCES categoria(id)
    )";

$result = mysqli_query($con, $sql);

if(!$result){
    die("Erro ao criar a tabela de categoria ".mysqli_error($con));
}else{
    echo "<h2>Tabela categoria criado com sucesso!</h2>";
}