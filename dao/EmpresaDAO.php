<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class EmpresaDAO extends Conexao{
    public function CadastrarEmpresa($nome, $telefone, $endereco){
        if ($nome == '') {
            return 0;
        } else {

            $conexao = parent::retornarConexao();

            $comando_sql = 'insert into tb_empresa
                        (nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
                        values(?,?,?,?);';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $telefone);
            $sql->bindValue(3, $endereco);
            $sql->bindValue(4, UtilDAO::UsuarioLogado());

            try {
                $sql->execute();
                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        }
    }

    public function ConsultarEmpresa(){
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_empresa, nome_empresa, telefone_empresa, endereco_empresa from tb_empresa where id_usuario = ? order by nome_empresa ASC';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::UsuarioLogado());

        $sql->setFetchMode((PDO::FETCH_ASSOC));
        $sql->execute();
        return $sql->fetchAll();
    }

    public function DetalharEmpresa($id_empresa){
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_empresa, nome_empresa, telefone_empresa, endereco_empresa
                        from tb_empresa
                        where id_empresa = ? 
                        and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        
        $sql->bindValue(1, $id_empresa);
        $sql->bindValue(2, UtilDAO::UsuarioLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function AlterarEmpresa($nome, $telefone, $endereco, $id_empresa){
        if (trim($nome) == '' || $id_empresa == '') {
            return 0;
        } else {
        $conexao = parent::retornarConexao();
        $comando_sql = 'update tb_empresa
                        set nome_empresa = ?, 
                            telefone_empresa = ?,
                            endereco_empresa = ?
                        where id_empresa = ?
                        and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $telefone);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, $id_empresa);
        $sql->bindValue(5, UtilDAO::UsuarioLogado());

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

    public function ExcluirEmpresa($id_empresa){
        if($id_empresa == ''){
            return 0;
        }else{
        $conexao = parent::retornarConexao();
        $comando_sql = 'delete from tb_empresa where id_empresa = ? and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $id_empresa);
        $sql->bindValue(2, UtilDAO::UsuarioLogado());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            return -4;
        }
        }
    }
}
