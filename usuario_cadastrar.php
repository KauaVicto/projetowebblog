<?php
    require_once "includes/conectaBD.php";
    $erro = "";
    $msg = "";
    $nome = "";
    $login = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome = filter_input(INPUT_POST, "nome");
        $login = filter_input(INPUT_POST, "login");
        $senha = filter_input(INPUT_POST, "senha");
        $confirma = filter_input(INPUT_POST, "confirma");

        /* Validações */

        if($nome == ""){
            $erro = "O nome é um campo obrigatório";
        }else if($login == ""){
            $erro = "O login é um campo obrigatório";
        }else if($senha == ""){
            $erro = "A senha é um campo obrigatório";
        }else if($senha != $confirma){
            $erro = "As senhas preenchidas estão diferentes";
        }else{

            $sql = "SELECT * FROM usuario WHERE login = ?";

            $preparada = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($preparada, 's', $login);
            mysqli_stmt_execute($preparada);

            $result = mysqli_stmt_get_result($preparada);
            $qt = mysqli_num_rows($result);

            if($qt != 0){
                $erro = "Esse login já está cadastrado no sistema!";
            }
        }

        /* Cadastro */
        
        if($erro == ""){
            $senha = sha1($senha);

            $sql = "INSERT INTO usuario (nome, login, senha) VALUES (?, ?, ?)";

            $preparada = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($preparada, "sss", $nome, $login, $senha);

            if(!mysqli_stmt_execute($preparada)){
                $erro = "O usuário não pode ser cadastrado, ocorreu um erro no sistema.";
            }else{
                //recupera um ID adicionado a partir de uma declareção preparada
                $id = mysqli_stmt_insert_id($preparada);

                $msg = "Usuário com ID $id cadastrado com sucesso";
                $nome = "";
                $login = "";
            }
        }

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

<form action="usuario_cadastrar.php" method="post">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Nome</span>
        <input type="text" class="form-control" name="nome" autocomplete="off" value="<?= $nome ?>">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Login</span>
        <input type="text" class="form-control" name="login" autocomplete="off" value="<?= $login ?>">
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