<?php

require_once '../DAO/UsuarioDAO.php';

if(isset($_POST['btnCadastrar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $repsenha = $_POST['repsenha'];

    $objdao = new UsuarioDAO();
    $ret = $objdao -> CadastrarUsuario($nome, $email, $senha, $repsenha);
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>
<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <?php include_once '_msg.php' ?>
                <h2> Controle Financeiro : Cadastro</h2>
                <h5>(Faça o cadastro da sua conta aqui)</h5>
                <br />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Preencher todos os campos:</strong>
                    </div>
                    <div class="panel-body">
                        <br />
                        <form role="form" action="cadastro.php" method="post">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle"></i></span>
                                <input name="nome" type="text" class="form-control" placeholder="Seu nome"  id="nome" value="<?=isset($nome) ? $nome : '' ?>"/>
                            </div>

                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input name="email" type="email" class="form-control" placeholder="Digite seu e-mail aqui..."  id="email" value="<?=isset($email) ? $email : '' ?>"/>
                            </div>
                            <div><i>Mínimo seis(6) caracteres!</i></div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input name="senha" type="password" class="form-control" placeholder="Digita uma senha (mínimo 6 caracteres)" id="senha" value="<?=isset($senha) ? $senha : '' ?>" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input name="repsenha" type="password" class="form-control" placeholder="Digite novamente sua senha..." id="repsenha" value="<?=isset($repsenha) ? $repsenha : '' ?>" />
                            </div>
                            <button name="btnCadastrar" class="btn btn-success " onclick="return ValidarCadastro()">Cadastrar</button>
                        </form>
                        <hr />
                        <span>Já possui uma conta?</span><a href="index.php">Clique aqui</a>
                    </div>

                </div>
            </div>


        </div>
    </div>

</body>

</html>