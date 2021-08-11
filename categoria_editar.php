<?php
    require_once "includes/conectaBD.php";
    $erro = '';
    $msg = '';
    $nome = '';

    $id = filter_input(INPUT_GET, 'id');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nome = filter_input(INPUT_POST, 'nome');

        if($nome == ""){
            $erro = "Nome da categoria é um campo obrigatório";
        }else{
            $sql = 'SELECT * FROM categoria WHERE nome = ? AND id <> ?';
            $prepare = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($prepare, 'si', $nome, $id);
            mysqli_stmt_execute($prepare);
            $result = mysqli_stmt_get_result($prepare);
            $qt = mysqli_num_rows($result);

            if($qt > 0){
                $erro = 'Nome da categoria já existente no sistema.';
            }
        }

        if($erro == ''){
            $sql = 'UPDATE categoria SET nome = ? WHERE id = ?';
            $prepare = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($prepare, 'si', $nome, $id);

            if(mysqli_stmt_execute($prepare)){

                $msg = "Categoria com o id $id editada com sucesso!";
                $nome = "";
            }else{
                $erro = "Categoria não pode ser editada!";
            }
        }
    }

    if($id != ""){
        $sql = "SELECT * FROM categoria WHERE id = ?";
        $prepare = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($prepare, 'i', $id);
        mysqli_stmt_execute($prepare);

        $result = mysqli_stmt_get_result($prepare);
        $qt = mysqli_num_rows($result);
        $categoria = mysqli_fetch_assoc($result);

        if($qt > 0){
            $nome = $categoria['nome'];
        }else{
            $_SESSION['erro'] = 'Categoria não encontrada.';
            header("location: categorias.php");
        }

        
    }

    include_once "topo.php";
    include_once "menu.php";
?>

<h2>Categorias</h2>

<a href="categorias.php" class="btn btn-secondary">Voltar</a>

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

<form action="categoria_editar.php?id=<?=$id?>" method="post">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Nome</span>
        <input type="text" class="form-control" name="nome" autocomplete="off" value="<?= $nome ?>">
    </div>
    <button type="Submit" class="btn btn-primary">Editar</button>
</form>


<?php include_once "rodape.php" ?>