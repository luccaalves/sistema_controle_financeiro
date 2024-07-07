<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class CategoriaDAO extends Conexao{
    public function CadastrarCategoria($nomecategoria){
        if(trim($nomecategoria) == ''){
            return 0;
        }else{
        //1° Passo: Criar uma variavel que receberá o objeto da Classe Conexão.
        $conexao = parent::retornarConexao();

        //2° Passo: Criar uma variavel que receberá o texto do comando SQL que deverá ser executado no BD 
        $comando_sql = 'insert into tb_categoria
                        (nome_categoria, id_usuario)
                        values(?, ?);';


        //3° Passo: Criar um objeto que será configurado e levado no BD para ser executado
        $sql = new PDOStatement();

        // 4° Passo: Colocar dentro do objeto $sql a conexão preparada para executar o comando_sql
        $sql = $conexao->prepare($comando_sql);

        //5° Passo: Verificar se no comando_sql eu tenho ? para ser configurado. Se tiver, configurar os bindValues
        $sql->bindValue(1, $nomecategoria);
        $sql->bindValue(2, UtilDAO::UsuarioLogado());

        //6° Passo: Executar no BD
        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    }   
    }
    public function ConsultarCategoria(){
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_categoria, nome_categoria
                        from tb_categoria
                        where id_usuario = ? order by nome_categoria ASC';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::UsuarioLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();

    
    }
    public function DetalharCategoria($id_categoria){
        $conexao = parent::retornarConexao();
        $comando_sql = 'select id_categoria, nome_categoria
                        from tb_categoria
                        where id_categoria =? 
                        and id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $id_categoria);
        $sql->bindValue(2, UtilDAO::UsuarioLogado());
        
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();

    }
    public function AlterarCategoria($nomecategoria, $id_categoria){
        if(trim($nomecategoria) == '' || $id_categoria == ''){
            return 0;
        }else{
            $conexao = parent::retornarConexao();
            $comando_sql = 'update tb_categoria
                            set nome_categoria = ?
                            where id_categoria = ?
                            and id_usuario = ?';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $sql->bindValue(1, $nomecategoria);
            $sql->bindValue(2, $id_categoria);
            $sql->bindValue(3, UtilDAO::UsuarioLogado());

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
    public function ExcluirCategoria($id_categoria){
        if($id_categoria == ''){
            return 0;
        }else{
            $conexao = parent::retornarConexao();
            $comando_sql = 'delete
                            from tb_categoria
                            where id_categoria = ?
                            and id_usuario = ?';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            
            $sql->bindValue(1, $id_categoria);
            $sql->bindValue(2, UtilDAO::UsuarioLogado());

            try{
                $sql->execute();
                return 1;
            }
            catch(Exception $ex){
                return -4;
            }
        }    
    }
}