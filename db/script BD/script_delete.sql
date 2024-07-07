-- COMANDO PARA EXCLUIR (DELETE)

-- Deleta todo o banco de dados com todas as suas tabelas.
drop database db_financeiro_ead;

-- Deleta a tabela especifica do banco de dados.
drop table tb_exemplo;

delete from tb_conta
	where id_conta = 1;
    
delete from tb_categoria
	where id_categoria = 1;
    
delete from tb_movimento
	where id_movimento = 1;    
    
delete from tb_empresa
	where id_empresa = 1;
    
delete from tb_servico
where id_servico = 1
and id_usuario = 1    

