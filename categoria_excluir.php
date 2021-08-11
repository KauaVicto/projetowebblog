<?php
require_once "includes/conectaBD.php";

    $id = filter_input(INPUT_GET, 'id');

    if($id){
        $sql = "DELETE FROM categoria WHERE id = ?";
        $prepare = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($prepare, 'i', $id);

        if(mysqli_stmt_execute($prepare)){
            $_SESSION['msg'] = "Categoria excluida com sucesso.";
        }else{
            $_SESSION['erro'] = "Categoria não pode ser excluida.";
        }
    }

    header("location: categorias.php");