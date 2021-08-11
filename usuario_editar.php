<?php
    require_once "includes/conectaBD.php";
    $erro = "";
    $msg = "";
    $nome = "";
    $login = "";

    $id = filter_input(INPUT_GET, "id");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = filter_input(INPUT_POST, 'nome');
        $login = filter_input(INPUT_POST, 'login');
        $senha = filter_input(INPUT_POST, 'senha');
        $confirma = filter_input(INPUT_POST, 'confirma');

        /* Validação */
        if($nome == ""){
            $erro = "Nome é um campo obrigatório";
        }else if($login == ""){
            $erro = "Login é um campo obrigatório";
        }else if($senha != $confirma){
            $erro = "As senhas não conferem";
        }else{
            $sql = "SELECT * FROM usuario WHERE login = ? AND id <> ?";
            $prepare = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($prepare, "si", $login, $id);
            mysqli_stmt_execute($prepare);

            $result = mysqli_stmt_get_result($prepare);
            $qt = mysqli_num_rows($result);

            if($qt != 0){
                $erro = "Login já existente, tente outro!";
            }
        }

        if($erro == ""){
            if($senha == ""){
                $sql = "UPDATE usuario SET nome = ?, login = ? WHERE id = ?";
            }else{
                $senha = sha1($senha);
                $sql = "UPDATE usuario SET nome = ?, login = ?, senha = ? WHERE id = ?";
            }

            $prepare = mysqli_prepare($con, $sql);
            if($senha == ""){
                mysqli_stmt_bind_param($prepare, "ssi", $nome, $login, $id);
            }else{
                mysqli_stmt_bind_param($prepare, "sssi", $nome, $login, $senha, $id);
            }
            if(mysqli_stmt_execute($prepare)){
                $msg = "Usuário editado com sucesso";
            }else{
                $erro = "Ouve um erro ao tentar editar o usuário, tente novamente.";
            }

        }
    }

    if($id){
        $sql = "SELECT * FROM usuario WHERE id = ?";
        $prepare = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($prepare, "i", $id);
        mysqli_stmt_execute($prepare);
        $result = mysqli_stmt_get_result($prepare);

        $usuario = mysqli_fetch_assoc($result);
        $nome = $usuario['nome'];
        $login = $usuario['login'];
    }

    include_once "topo.php";
    include_once "menu.php";
?>

<h2>Usuários</h2>

<a href="usuarios.php" class="btn btn-secondary">Voltar</a>

    <?php if($erro != ""){ ?>
        <div class="alert alert-danger" role="alert">
            <?= $erro ?>
        </div>
    <?php } ?>
    <?php if($msg != ""){ ?>
        <div class="alert alert-success" role="alert">
            <?= $msg ?>
        </div>
    <?php } ?>

<form action="usuario_editar.php?id=<?=$id?>" method="post">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Nome</span>
        <input type="text" class="form-control" name="nome" autocomplete="off" value="<?= $nome ?>">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Login</span>
        <input type="text" class="form-control" <?=$id == 1 ? "readonly" : "" ?> name="login" autocomplete="off" value="<?= $login ?>">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Senha</span>
        <input type="password" class="form-control" name="senha">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Confirmar Senha</span>
        <input type="password" class="form-control" name="confirma">
    </div>
    <button type="Submit" class="btn btn-primary">Cadastrar</button>
</form>


<?php include_once "rodape.php" ?>