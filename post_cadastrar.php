<?php
    require_once "includes/conectaBD.php";
    $erro = "";
    $msg = "";
    $titulo = "";
    $conteudo = "";
    
    $sql = "SELECT * FROM categoria";
    $resultCat = mysqli_query($con, $sql);
    $qtCat = mysqli_num_rows($resultCat);

    $categorias = mysqli_fetch_all($resultCat, MYSQLI_ASSOC);

    include_once "topo.php";
    include_once "menu.php";
?>

<h2>Posts</h2>

<a href="posts.php" class="btn btn-secondary">Voltar</a>

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

<form action="post_cadastrar.php" method="post">
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Título</span>
        <input type="text" class="form-control" name="titulo" autocomplete="off" value="<?= $titulo ?>">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Conteúdo</span>
        <textarea name="conteudo" id="conteudo" cols="30" rows="10" class="form-control"><?= $conteudo ?></textarea>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Imagem</span>
        <input type="file" name="imagem" id="imagem" class="form-control">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Usuário</span>
        <input type="text" name="imagem" readonly id="imagem" class="form-control" value="<?= $_SESSION['usuario'] ?>">
    </div>
    <label class="form-check-label">Categorias:</label>
    <?php foreach($categorias as $cat){ ?>
        <div class="form-check">
            <input name="categorias[]" class="form-check-input" type="checkbox" value="<?=$cat['id']?>" id="<?=$cat['nome']?>">
            <label class="form-check-label" for="<?=$cat['nome']?>">
                <?= $cat['nome'] ?>
            </label>
        </div>
    <?php } ?>
    <button type="Submit" class="btn btn-primary">Cadastrar</button>
</form>


<?php include_once "rodape.php" ?>