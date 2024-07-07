<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/CategoriaDAO.php';

if(isset($_POST['btnGravar'])){
    $nomecategoria = $_POST['nome'];

    $objdao = new CategoriaDAO();
    $ret = $objdao-> CadastrarCategoria($nomecategoria);

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
                        <h2>Cadastrar Categoria Financeira.</h2>
                        <h5>Aqui você poderá cadastrar todas as suas categorias Financeiras.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method="post" action="nova_categoria.php">
                <div class="form-group">
                    <label>Digite o Nome da Categoria:</label>
                    <input class="form-control" name="nome" placeholder="Digite o nome da categoria. Exeplo: Conta de Luz" id="nomecategoria" maxlength="35" value="<?=isset($nomecategoria) ? $nomecategoria : '' ?>"/>
                </div>
                <button type="submit" onclick="return ValidarCategoria()" name="btnGravar" class="btn btn-success">Gravar</button>
                </form>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->



</body>

</html>