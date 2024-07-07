<?php

//Futuramente essa classe irá gerar a sessão do usuário, permitindo o acesso na aplicação.
// De inicio, vamos apenas simular um acesso de um suposto usuário logado na aplicação.

class UtilDAO{
    private static function IniciarSessao(){
        if (!isset($_SESSION)){
            session_start();
        }
    }

    public static function CriarSessao($cod, $nome){
        self::IniciarSessao();

        $_SESSION['cod'] = $cod;
        $_SESSION['nome'] = $nome;
    }

    public static function UsuarioLogado(){
        self::IniciarSessao();
        return $_SESSION['cod'];
    }
    public static function NomeLogado(){
        self::IniciarSessao();
        return $_SESSION['nome'];
    }
    public static function Deslogar(){
        self::IniciarSessao();
        unset($_SESSION['cod']);
        unset($_SESSION['nome']);

        header('location: index.php');
        exit;
    }
    public static function VerificarLogado(){
        self::IniciarSessao();
        if (!isset($_SESSION['cod']) || $_SESSION['cod'] == ''){
            header('location: index.php');
            exit;
        }
    }
    public function dd(mixed $params = []): void{
        echo "<pre>";
        print_r($params);
        echo "</pre>";
        exit;
    }
}
