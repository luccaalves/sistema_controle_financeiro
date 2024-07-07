<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class UsuarioDAO extends Conexao{
    public function ValidarLogin($email, $senha){
        if($email == '' || $senha == ''){
            return 0;
        }elseif(strlen($senha) < 6){
            return -2;
        }else{
            $conexao = parent::retornarConexao();
            $comando_sql = 'select id_usuario, nome_usuario from tb_usuario where email_usuario = ? and senha_usuario = ?';

            $sql  = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $email);
            $sql->bindValue(2, $senha);

            $sql->setFetchMode(PDO::FETCH_ASSOC);

            $sql->execute();

            $user = $sql->fetchAll();

            if(count($user) == 0){
                return -6;
            }

            $cod = $user[0]['id_usuario'];
            $nome = $user[0]['nome_usuario'];
            UtilDAO::CriarSessao($cod, $nome);
            header('location: tela_inicial.php');
            exit;

        }


    }

    public function VerificarEmailDuplicadoCadastro($email){
        if(trim($email) == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'select count(email_usuario) as contar from tb_usuario where email_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar'];
    }
    
    public function VerificarEmailDuplicadoAlteracao($email){
        if(trim($email) == ''){
            return 0;
        }

        $conexao = parent::retornarConexao();
        $comando_sql = 'select count(email_usuario) as contar from tb_usuario where email_usuario = ? and id_usuario != ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, UtilDAO::UsuarioLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        $contar = $sql->fetchAll();

        return $contar[0]['contar'];
    }

    public function CadastrarUsuario($nome, $email, $senha, $repsenha){
        if($nome == '' || $email == '' || $senha == '' || $repsenha == ''){
            return 0;
        }
        elseif(strlen($senha) < 6){
            return -2;
        }
        elseif($senha != $repsenha){
            return -3;
        }elseif($this->VerificarEmailDuplicadoCadastro($email) != 0){
            return -5;
        }else{
            $conexao = parent::retornarConexao();

            $comando_sql = 'insert into tb_usuario(nome_usuario, email_usuario, senha_usuario, data_cadastro)
            values(?, ?, ?, ?);';

            $sql = new PDOStatement;

            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $email);
            $sql->bindValue(3, $senha);
            $sql->bindValue(4, date('Y-m-d'));

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }

    }

    public function CarregarMeusDados(){
        $conexao = parent::retornarConexao();
        $comando_sql = 'select nome_usuario, email_usuario, senha_usuario from tb_usuario where id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::UsuarioLogado());

        //Romevo os index dentro o array, permanecendo somente com as colunas do BD
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();

    }

    public function GravarMeusDados($nome, $email, $senha){
        if(trim($nome) == '' || trim($email) == '' || trim($senha)==''){
            return 0;
        }elseif($this->VerificarEmailDuplicadoAlteracao($email) != 0){
            return -5;
        }else{
        $conexao = parent::retornarConexao();
        $comando_sql = 'update tb_usuario set nome_usuario = ?, email_usuario = ?, senha_usuario = ? where id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $senha);
        $sql->bindValue(4, UtilDAO::UsuarioLogado());

        try{
            $sql->execute();
            return 1;
        }
        catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        } 
        }       
    }
}