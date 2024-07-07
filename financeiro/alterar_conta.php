<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';

$objdao = new ContaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $id_conta = $_GET['cod'];

    $dados = $objdao->DetalharConta($id_conta);

    if (count($dados) == 0) {
        header('location: consultar_conta.php');
    }
} elseif (isset($_POST['btnSalvar'])) {
    $id_conta = $_POST['cod'];
    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $numero = $_POST['numero'];
    $saldo = $_POST['saldo'];

    $ret = $objdao->AlterarConta($banco, $numero, $agencia, $saldo, $id_conta);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} elseif (isset($_POST['btnExcluir'])) {
    $id_conta = $_POST['cod'];

    $ret = $objdao->ExcluirConta($id_conta);
    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_conta.php');
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
                        <?php include_once '_msg.php' ?>
                        <h2>Alterar Conta Bancária.</h2>
                        <h5>Aqui você poderá Alterar ou Excluir todas as suas Conta Bancárias.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="alterar_conta.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_conta'] ?>" />
                    <div class="form-group">
                        <label>Nome do Banco:*</label>
                        <input class="form-control" name="banco" placeholder="Digite o nome do Banco..." id="banco" value="<?= $dados[0]['banco_conta'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Agência:*</label>
                        <input type="number" class="form-control" name="agencia" placeholder="Digite a Agência..." id="agencia" value="<?= $dados[0]['agencia_conta'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Número da Conta:*</label>
                        <input type="number" class="form-control" name="numero" placeholder="Digite o Número da Conta..." id="numero" value="<?= $dados[0]['numero_conta'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Saldo do Banco:*</label>
                        <input class="form-control" name="saldo" placeholder="Digite o saldo da conta..." id="saldo" value="<?= $dados[0]['saldo_conta'] ?>" />
                    </div>
                    <button type="submit" name="btnSalvar" class="btn btn-success" onclick="return ValidarConta()">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>

                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja Excluir a conta: <b><?= $dados[0]['banco_conta'] ?> / Ag: <?= $dados[0]['agencia_conta'] ?> - N°: <?= $dados[0]['numero_conta'] ?>?</b>
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
    </div>



</body>

</html>