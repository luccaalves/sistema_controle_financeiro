<?php

if(isset($_GET['ret'])){
    $ret = $_GET['ret'];
}

if(isset($ret)){
    switch($ret){
        case 1:
            echo '<div class="alert alert-success">Ação realizada com sucesso!</div>';
        break;
        case 0:
            echo '<div class="alert alert-warning">Preencha o(s) Campo(s) Obrigatório(s)!</div>';
        break;
        case -1:
            echo '<div class="alert alert-danger">Ocorreu um erro na operação. Tente mais tarde!</div>';
        break;
        case -2:
            echo '<div class="alert alert-danger">A Senha Deverá Conter no Minímo 6 Caracteres!</div>';
        break;
        case -3:
            echo '<div class="alert alert-danger">As Senhas Devem ser Iguais! </div>';
        break;
        case -4:
            echo '<div class="alert alert-danger">O registro não poderá ser excluido, pois está em uso! </div>';
        break;
        case -5:
            echo '<div class="alert alert-danger">E-mail já cadastrado. Coloque um outro e-mail!</div>';
        break;
        case -6:
            echo '<div class="alert alert-danger">Usuário não encontrado!</div>';
        break;
    }
}