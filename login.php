<?php
    require_once "includes/conectaBD.php";
    $erro = "";

    if(isset($_SESSION["erro"])){
        $erro = $_SESSION["erro"];
        unset($_SESSION["erro"]);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $login = filter_input(INPUT_POST, "login");
        $senha = sha1(filter_input(INPUT_POST, "senha"));
        
        $sql = "SELECT * FROM usuario WHERE login = ? LIMIT 1";

        $preparada = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($preparada, "s", $login);
        mysqli_stmt_execute($preparada);


        $result = mysqli_stmt_get_result($preparada);
        $qt = mysqli_num_rows($result);

        if($qt == 1){
            $usuarioBD = mysqli_fetch_assoc($result);

            if($senha == $usuarioBD["senha"]){
                $_SESSION["logado"] = true;
                $_SESSION["usuario"] = $login;
                $_SESSION["id_usuario"] = $usuarioBD['id'];

                header("location: painel.php");

            }else{
                $erro = "Usuário ou senha não confere!";
            }

        }else{
            $erro = "Usuário não cadastrado no sistema!";
        }
    }

?>

<?php include_once "topo.php" ?>

<form action="login.php" method="post">
    <div class="mb_3">
        <h1>Login</h1>
    </div>
    <?php if($erro != ""){ ?>
        <div class="alert alert-danger" role="alert">
            <?= $erro ?>
        </div>
    <?php } ?>
    <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input class="form-control" type="text" id="login" name="login">
    </div>
    <div class="mb-3">
        <label for="senha" class="form-label">Senha</label>
        <input class="form-control" type="password" id="senha" name="senha">
    </div>
    <button type="submit" class="btn btn_primary">Entrar</button>
</form>

<?php include_once "rodape.php" ?>