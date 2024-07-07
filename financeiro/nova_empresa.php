<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/EmpresaDAO.php';

if (isset($_POST['btnGravar'])) {
    $nome = trim(($_POST)['nome']);
    $telefone = trim(($_POST)['telefone']);
    $endereco = trim(($_POST)['endereco']);

    $objdao = new EmpresaDAO();
    $ret = $objdao->CadastrarEmpresa($nome, $telefone, $endereco);
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
                        <h2>Cadastrar Empresas</h2>
                        <h5>Aqui você Poderá Cadastrar todos os nomes das Empresas </h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_empresa.php" method="post">
                    <div class="form-group">
                        <label>Nome da Empresa;*</label>
                        <input class="form-control" name="nome" placeholder="Digite o nome da Empresa. Exemplo: Casas Bahia..."  id="nomeempresa"/>
                    </div>
                    <div class="form-group">
                        <label>Telefone/Whatsapp;</label>
                        <input name="telefone" id="telefone" class="form-control" placeholder="Digite seu Telefone/Whatsapp da Empresa (Opcional)" />
                    </div>
                    <div class="form-group">
                        <label>Endereço;</label>
                        <input name="endereco" id="endereco" class="form-control" placeholder="Digite Endereço da Empresa (Opcional)" />
                    </div>
                    <button type="submit" name="btnGravar" onclick="return ValidarEmpresa()" class="btn btn-success">Salvar</button>
                </form>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
</body>
</html>