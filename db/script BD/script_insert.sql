-- COMANDO PARA INSERIR (CREATE)
-- insert into nome_da_tabela (colunas) values (valores)

insert into tb_usuario 
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Lucca','luccademorais@gmail.com','123456','2024-03-22');


insert into tb_categoria
(nome_categoria, id_usuario)
values
('' );


insert into tb_empresa
(nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
values
('', '', '' );


insert into tb_conta
(banco_conta, agencia_conta, numero_conta, saldo_conta, id_usuario)
values 
('', '', '' );

-- ENTRADA
insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario)
values
();

-- SAIDA
insert into tb_movimento
(tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario)
values
();


insert into tb_cliente
			(nome_cliente, telefone_cliente, data_nascimento, endereco_local, bairro_cliente, cidade_cliente, obs_cliente, id_usuario)
			values(?, ?, ?, ?, ?, ?, ?, ?);