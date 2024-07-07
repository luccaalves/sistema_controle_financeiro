select nome_usuario, data_cadastro
	from tb_usuario
    where nome_usuario like '%a';
    
select nome_usuario, data_cadastro
	from tb_usuario
where data_cadastro between '2024-01-01' and '2024-04-01';

select banco_conta, agencia_conta, saldo_conta
	from tb_conta
    where id_usuario = 1;

select tb_movimento.id_usuario, tipo_movimento, date_format(data_movimento, "%d/%m/%Y") as data_movimento, valor_movimento, nome_categoria, nome_empresa, nome_usuario, banco_conta, obs_movimento
    from tb_movimento
    inner join tb_categoria
    on tb_categoria.id_categoria = tb_movimento.id_categoria
    inner join tb_empresa
    on tb_empresa.id_empresa = tb_movimento.id_movimento
    inner join tb_usuario
    on tb_usuario.id_usuario = tb_movimento.id_usuario
    inner join tb_conta
    on tb_conta.id_conta = tb_movimento.id_conta
    where tb_movimento.obs_movimento is null;
    
    select sum(valor_movimento) as total
    from tb_movimento
    where tipo_movimento = 1
