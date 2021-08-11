<?php
    require_once "includes/conectaBD.php";
    require_once "protegido.php";

    $erro = '';
    $msg = '';

    $sql = "SELECT * FROM categoria";

    $result = mysqli_query($con, $sql);
    $qt = mysqli_num_rows($result);

    if(isset($_SESSION["erro"])){
        $erro = $_SESSION["erro"];
        unset($_SESSION["erro"]);
    }
    if(isset($_SESSION["msg"])){
        $msg = $_SESSION["msg"];
        unset($_SESSION["msg"]);
    }

    require_once "topo.php";
    require_once "menu.php";
?>

<h2>Categorias</h2>

<a href="categoria_cadastrar.php" class="btn btn-primary">Criar Uma nova categoria</a>

<h4><?=$qt?> usuário(s) cadastrado(s) no sistema.</h4>



<?php if($qt > 0){ ?>
    <table class="table table-dark table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php while($categoria = mysqli_fetch_assoc($result)){ ?>
            <tr>
            <th scope="row"><?=$categoria["id"]?></th>
            <td><?=$categoria["nome"]?></td>
            <td>
                <a href="categoria_editar.php?id=<?= $categoria['id'] ?>" class="btn btn-warning" title="Editar usuário">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                    </svg>
                </a>

                <a href="categoria_excluir.php?id=<?=$categoria["id"]?>" class="btn btn-warning" title="Excluir usuário">
                    Excluir
                </a>
            </td>
            </tr>
        <?php } ?>

    </tbody>
    </table>

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
<?php } ?>


<?php require_once "rodape.php" ?>