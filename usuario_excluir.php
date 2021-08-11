<?php
    require_once "includes/conectaBD.php";

    $id = filter_input(INPUT_GET, "id");

    if($id == "1"){
        $_SESSION["erro"] = "Não é possível excluir o usuário padrão.";
        header("location: usuarios.php");
        die();
    }

    if($id != ""){
        $sql = "DELETE FROM usuario WHERE id = ?";

        $preparada = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($preparada, "i", $id);

        if(mysqli_stmt_execute($preparada)){
            $_SESSION["msg"] = "Usuário excluido com sucesso.";
        }else{
            $_SESSION["erro"] = "Erro ao excluir usuário.";
        }             
    }
    
    header("location: usuarios.php");