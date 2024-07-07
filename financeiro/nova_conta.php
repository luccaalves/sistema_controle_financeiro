<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/ContaDAO.php';

if(isset($_POST['btnGravar'])){
    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $numero = $_POST['numero'];
    $saldo = $_POST['saldo'];

    $objdao = new ContaDAO();
    $ret = $objdao->CadastrarConta($banco, $numero, $agencia, $saldo);
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
                        <h2>Cadastrar Conta Bancária.</h2>
                        <h5>Aqui você poderá cadastrar todas as suas Conta Bancárias.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_conta.php" method="post">
                <div class="form-group">
                        <label>Nome do Banco:*</label>
                        <input class="form-control" name="banco" placeholder="Digite o nome do Banco..." id="banco" value="<?= isset($banco) ? $banco : '' ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Agência:*</label>
                        <input type="number" class="form-control" name="agencia" placeholder="Digite a Agência..." id="agencia" value="<?= isset($agencia) ? $agencia : '' ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Número da Conta:*</label>
                        <input type="number" class="form-control" name="numero" placeholder="Digite o Número da Conta..." id="numero" value="<?= isset($numero) ? $numero : '' ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Saldo do Banco:*</label>
                        <input class="form-control" name="saldo" placeholder="Digite o saldo da conta..." id="saldo" value="<?= isset($saldo) ? $saldo : '' ?>" />
                    </div>
                    <button type="submit" name="btnGravar" class="btn btn-success" onclick="return ValidarConta()">Gravar</button>
                </form>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>



</body>

</html>