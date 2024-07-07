-- COMANDO PARA ATUALIZAR (UPDATE)

update tb_usuario
	set email_usuario = 'luccademorais@gmail.com',
		senha_usuario = 'lucca123'
where id_usuario = 1;    

update tb_categoria
	set email_usuario = 'Lais2002oliveira@gmail.com'
where id_usuario = 2;          

update tb_categoria
	set nome_categoria = 'Roupas'
    where id_categoria = 1
    and id_usuario = 1;
    
    update tb_empresa
		set nome_empresa = 'StarPoint', 
			telefone_empresa = '(43)3345-2078',
			endereco_empresa = 'Av. Theodoro Victorelli, 150' 
		where id_empresa = 1
		and id_usuario = 1;
        
        
update tb_cliente
	set banco_conta = 'Santander', 
		agencia_conta = '77843205',
		numero_conta = '0001',
		saldo_conta = '0.00'
		where id_conta = 1
		and id_usuario = 1;
        
        
update tb_cliente
     set nome_cliente = 'Lucca Gabriel Alves', telefone_cliente = '(43)3345-2078', data_nascimento= '1999-07-14', endereco_cliente = 'Av São João 1329', bairro_cliente = 'Jardim Brasilia', cidade_cliente = 'Londrina'
                            where id_cliente = 1
                            and id_usuario = 1;