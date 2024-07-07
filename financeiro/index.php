<?php

require_once '../DAO/UsuarioDAO.php';

if (isset($_POST['btnAcessar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $objdao = new UsuarioDAO();

    $ret = $objdao->ValidarLogin($email, $senha);
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br />
                <br />
                <?php include_once '_msg.php' ?>
                <h2> Sistema Financeiro : ACESSO</h2>
                <h5>( Faça seu login de acesso )</h5>
                <br />
            </div>
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Preencha todos os campos: </strong>
                    </div>
                    <div class="panel-body">
                        <br />
                        <form role="form" method="post" action="index.php">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input name="email" type="text" class="form-control" placeholder="Digite seu e-mail... " id="email" value="<?= isset($email) ? $email : '' ?>" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input name="senha" type="password" class="form-control" placeholder="Digite sua senha..." id="senha" value="<?= isset($senha) ? $senha : '' ?>" />
                            </div>
                            <button name="btnAcessar" class="btn btn-success" onclick="return ValidarLogin()">Acessar</button>
                            <span>Caso não tenha cadastro, ? </span><a href="cadastro.php">Clique aqui!... </a>
                            <hr />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>