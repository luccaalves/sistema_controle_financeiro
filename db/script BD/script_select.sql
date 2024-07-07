-- COMANDO PARA CONSULTAR (READ)

select * from tb_usuario;

select * from tb_cliente;

select * from tb_confirma_servico;

select * from tb_movimento;

select id_cliente, nome_cliente, telefone_cliente, data_nascimento, endereco_cliente, bairro_cliente, cidade_cliente, obs_cliente
                        from tb_cliente
                        where id_cliente = 2
                        and id_usuario = 1        