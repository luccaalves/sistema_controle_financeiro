<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/EmpresaDAO.php';

$objdao = new EmpresaDAO();

if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
    $id_empresa=$_GET['cod'];

    $dados =$objdao->DetalharEmpresa($id_empresa);

    if(count($dados)==0){
        header('location: consultar_empresa.php');
        exit;
    }

}elseif(isset($_POST['btnSalvar'])){
    $id_empresa = $_POST['cod'];
    $nome= $_POST['nomeempresa'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $ret = $objdao-> AlterarEmpresa($nome, $telefone, $endereco, $id_empresa);
    header('location: consultar_empresa.php?ret=' . $ret);
    exit;

}elseif(isset($_POST['btnExcluir'])){
    $id_empresa = $_POST['cod'];

    $ret = $objdao->ExcluirEmpresa($id_empresa);
    header('location: consultar_empresa.php?ret=' . $ret);
    exit;


}else{
    header ('location: consultar_empresa.php');
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
                        <h2>Alterar ou Excluir Empresa.</h2>
                        <h5>Aqui você Poder Alterar ou Excluir sua Empresas </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form method="post" action="alterar_empresa.php">
                    <input type="hidden" name="cod" value="<?=$dados[0]['id_empresa'] ?>">
                <div class="form-group">
                    <label>Nome da Empresa;*</label>
                    <input class="form-control" placeholder="Digite o nome da Empresa. Exemplo: Casas Bahia..." name="nomeempresa" id="nomeempresa" value="<?=$dados[0]['nome_empresa'] ?>"/>
                </div>
                <div class="form-group">
                    <label>Telefone/Whatsapp;</label>
                    <input  class="form-control" placeholder="Digite seu Telefone/Whatsapp da Empresa (Opcional)" name="telefone" id="telefone" value= "<?=$dados[0]['telefone_empresa'] ?>"/>
                </div>
                <div class="form-group">
                    <label>Endereço;</label>
                    <input class="form-control" placeholder="Digite Endereço da Empresa (Opcional)" name="endereco" id="endereco" value="<?=$dados[0]['endereco_empresa'] ?>"/>
                </div>
                <button type="submit" name="btnSalvar" class="btn btn-success" onclick="return ValidarEmpresa()">Salvar</button>
                <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Excluir</button>
                
                <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                            </div>
                            <div class="modal-body">
                            <span>Nome da Empresa:</span>
                            <strong><?= $dados[0]['nome_empresa'] ?>.</strong>
                            <br>
                            <span>Telefone (WhatsApp):</span>
                            <strong><?= $dados[0]['telefone_empresa'] ?>.</strong>
                            <br>
                            <span>Endereço:</span>
                            <strong><?= $dados[0]['endereco_empresa'] ?>.</strong>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                <button name="btnExcluir" type="submit" class="btn btn-danger">Excluir</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>



</body>

</html>