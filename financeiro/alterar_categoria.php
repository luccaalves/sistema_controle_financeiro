<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

$objdao = new CategoriaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $id_categoria = $_GET['cod'];
    $dados = $objdao->DetalharCategoria($id_categoria);

    //Se tem alguma coisa dentro do ARRAY $dados
    if (count($dados) == 0) {
        header('location: consultar_categoria.php');
        exit;
    }
} else if (isset($_POST['btnSalvar'])) {
    $id_categoria = $_POST['cod'];
    $nomecategoria = $_POST['nomecategoria'];

    $ret = $objdao->AlterarCategoria($nomecategoria, $id_categoria);

    header('location: consultar_categoria.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {
    $id_categoria = $_POST['cod'];
    $ret = $objdao->ExcluirCategoria($id_categoria);

    header('location: consultar_categoria.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_categoria.php');
    exit;
}


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php'; ?>
                        <h2>Alterar ou Excluir Categoria Financeira. </h2>
                        <h5>Aqui você pode Alterar ou Excluir sua Categoria Financeira.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method="post" action="alterar_categoria.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                    <div class="form-group">
                        <label>Digite o Nome da Categoria:</label>
                        <input class="form-control" name="nomecategoria" placeholder="Digite o nome da categoria. Exeplo: Conta de Luz" id="nomecategoria" maxlength="35" value="<?= $dados[0]['nome_categoria']?>" />
                    </div>
                    <button type="submit" onclick="return ValidarCategoria()" name="btnSalvar" class="btn btn-success">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>
                
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja Excluir a categoria: <b><?= $dados[0]['nome_categoria'] ?> ?</b>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                    <button name="btnExcluir" type="submit" class="btn btn-danger">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->



</body>

</html>