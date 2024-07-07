<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/ContaDAO.php';

$tipomov = '';
$categoria ='';
$empresa ='';
$conta = '';

if (isset($_POST['btnGravar'])) {
    $tipomov = $_POST['tipomov'];
    $data = $_POST['data'];
    $valor = trim($_POST['valor']);
    $categoria = $_POST['categoria'];
    $empresa = $_POST['empresa'];
    $conta = $_POST['conta'];
    $obs = trim($_POST['obs']);


    $objdao = new MovimentoDAO();
    $ret = $objdao->RealizarMovimento($tipomov, $data, $valor, $obs, $categoria, $empresa, $conta);
}

$objcategoria = new CategoriaDAO();
$objempresa = new EmpresaDAO();
$objconta = new ContaDAO();

$categorias = $objcategoria->ConsultarCategoria();
$empresas = $objempresa->ConsultarEmpresa();
$contas = $objconta->ConsultarConta();

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
                        <h2>Realizar Movimentação Bancaria</h2>
                        <h5>Aqui você Poderá Realizar todos os seus Movimentos Bancários. (Fluxo de Caixa)</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="realizar_movimento.php" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Selecione um Tipo do Movimento;*</label>
                            <select name="tipomov" id="tipomov" class="form-control">
                                <option value="">Selecione</option>
                                <option value="1" <?= $tipomov == 1 ? 'selected' : ''  ?>>Entrada</option>
                                <option value="2" <?= $tipomov == 2 ? 'selected' : ''  ?>>Saída</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Selecione uma Data;*</label>
                            <input name="data" id="data" type="date" class="form-control" value="<?= isset($data) ? $data : '' ?>" />
                        </div>
                        <div class="form-group">
                            <label>Valor do Movimento;*</label>
                            <input name="valor" id="valor" class="form-control" placeholder="Digite o Valor do Movimento aqui..." value="<?= isset($valor) ? $valor : '' ?>" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Selecione uma Categoria;*</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($categorias as $item) { ?>
                                    <option value="<?= $item['id_categoria'] ?>" <?= $categoria == $item['id_categoria'] ? 'selected' : ''  ?>><?= $item['nome_categoria'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Selecione uma Empresa;*</label>
                            <select name="empresa" id="empresa" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($empresas as $item) { ?>
                                    <option value="<?= $item['id_empresa'] ?>" <?= $empresa == $item['id_empresa'] ? 'selected' : ''  ?>><?= $item['nome_empresa'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Selecione uma Conta Bancária;*</label>
                            <select name="conta" id="conta" class="form-control">
                                <option value="">Selecione</option>
                                <?php foreach ($contas as $item) { ?>
                                    <option value="<?= $item['id_conta'] ?>" <?= $conta == $item['id_conta'] ? 'selected' : ''  ?>><?=$item['banco_conta'] . ' - Ag: ' . $item['agencia_conta'] . ' /' . ' Ct: ' . $item['numero_conta'] . '| R$' . number_format($item['saldo_conta'], 2, ',', '.')?> </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Digite uma Observação (Opcional)</label>
                            <textarea name="obs" id="obs" class="form-control" rows="4" placeholder="Digite sua obeservação aqui..." value="<?= isset($obs) ? $obs : '' ?>"></textarea>
                        </div>
                        <div style="text-align: center;">
                            <button type="submit" name="btnGravar" class="btn btn-success" onclick="return ValidarMovimento()">Finalizar Lançamento</button>
                        </div>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>
</html>