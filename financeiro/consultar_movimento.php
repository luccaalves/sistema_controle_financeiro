<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/MovimentoDAO.php';


$tipomov = '';
$datainicio = '';
$datafinal = '';

if (isset($_POST['btnFiltrar'])) {
    $tipomov = $_POST['tipomov'];
    $datainicio = $_POST['datainicio'];
    $datafinal = $_POST['datafinal'];

    $objdao = new MovimentoDAO;
    $movs = $objdao->ConsultarMovimento($tipomov, $datainicio, $datafinal);
}elseif(isset($_POST['btnExcluir'])){
    $id_movimento = $_POST['id_movimento'];
    $id_conta = $_POST['id_conta'];
    $tipomov = $_POST['tipomov'];
    $valor = $_POST['valor'];

    $objdao = new MovimentoDAO();
    $ret = $objdao->ExcluirMovimento($id_movimento, $id_conta, $valor, $tipomov);
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
                        <h2>Consultar Movimentações Financeiras.</h2>
                        <h5>Aqui você pode realizar a consulta das sua Movimentações Financeiras (Fluxo de Caixa). </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="consultar_movimento.php" method="post">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Selecione um Tipo do Movimento;</label>
                            <select class="form-control" name="tipomov" id="tipomov">
                                <option value="0" <?= $tipomov == 0 ? 'selected' : '' ?>>Todos</option>
                                <option value="1" <?= $tipomov == 1 ? 'selected' : '' ?>>Entrada</option>
                                <option value="2" <?= $tipomov == 2 ? 'selected' : '' ?>>Saída</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Selecione uma Data Incial;*</label>
                            <input type="date" class="form-control" placeholder="Coloque a data do Movimento" name="datainicio" id="datainicio" value="<?= $datainicio ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Selecione um Data Final;*</label>
                            <input type="date" class="form-control" placeholder="Coloque a data do Movimento" name="datafinal" id="datafinal" value="<?= $datafinal ?>" />
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <button name="btnFiltrar" class="btn btn-info" onclick="return ValidarConsultaPeriodo()">Filtrar Movimentos</button>
                    </div>
                </form>
                <hr>
                <?php if (isset($movs)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span>Esse é o Resultado da consulta Realizada </span>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Tipo do Movimento</th>
                                                    <th>Data do Movimento</th>
                                                    <th>Valor</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Conta</th>
                                                    <th>Observação</th>
                                                    <th>Ação</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;

                                                for ($i = 0; $i < count($movs); $i++) {

                                                    if ($movs[$i]['tipo_movimento'] == 1) {
                                                        $total = $total + $movs[$i]['valor_movimento'];
                                                    } else {
                                                        $total = $total - $movs[$i]['valor_movimento'];
                                                    }

                                                ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?></td>
                                                        <td><?= $movs[$i]['data_movimento'] ?></td>
                                                        <td>R$<?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?> </td>
                                                        <td><?= $movs[$i]['nome_categoria'] ?> </td>
                                                        <td><?= $movs[$i]['nome_empresa'] ?> </td>
                                                        <td><?= $movs[$i]['banco_conta'] ?> - Ag: <?= $movs[$i]['agencia_conta'] ?> / CT: <?= $movs[$i]['numero_conta'] ?> | R$<?= number_format($movs[$i]['saldo_conta'], 2, ',', '.') ?> </td>
                                                        <td><?= $movs[$i]['obs_movimento'] ?></td>
                                                        <td>
                                                            <button type="button" data-toggle="modal" data-target="#modalExcluir<?= $i ?>" class="btn btn-danger">Excluir</button>
                                                            <form method="post" action="consultar_movimento.php">
                                                                <input type="hidden" name="id_movimento" value="<?= $movs [$i]['id_movimento']?>">
                                                                <input type="hidden" name="id_conta" value="<?= $movs [$i]['id_conta']?>">
                                                                <input type="hidden" name="tipomov" value="<?= $movs [$i]['tipo_movimento']?>">
                                                                <input type="hidden" name="valor" value="<?= $movs [$i]['valor_movimento']?>">
                                                            <div class="modal fade" id="modalExcluir<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel"><strong> Deseja Excluir o Movimento? </strong></h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <strong><span>Tipo: </span></strong><?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?>
                                                                            <br>
                                                                            <strong><span>Data: </span></strong><?= $movs[$i]['data_movimento'] ?>
                                                                            <br>
                                                                            <strong><span>Valor: </span></strong>R$: <?= number_format($movs[$i]['valor_movimento'], 2, ',', '.') ?>
                                                                            <br>
                                                                            <strong><span>Categoria: </span></strong><?= $movs[$i]['nome_categoria'] ?>
                                                                            <br>
                                                                            <strong><span>Empresa: </span></strong><?= $movs[$i]['nome_empresa'] ?>
                                                                            <br>
                                                                            <strong><span>Conta: </span></strong><?= $movs[$i]['banco_conta'] ?> - Ag: <?= $movs[$i]['agencia_conta'] ?> / CT: <?= $movs[$i]['numero_conta'] ?> | R$<?= number_format($movs[$i]['saldo_conta'], 2, ',', '.') ?>
                                                                            <br>
                                                                            <strong><span>Observação: </span></strong><?= $movs[$i]['obs_movimento'] ?>
                                                                            <br>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                                                            <button name="btnExcluir" type="submit" class="btn btn-danger">Excluir</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <center>
                                            <label style="color:<?= $total < 0 ? 'red' : 'green' ?> ;">TOTAL: R$ <?= number_format($total, 2, ',', '.'); ?></label>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>
                <?php } ?>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>

</html>