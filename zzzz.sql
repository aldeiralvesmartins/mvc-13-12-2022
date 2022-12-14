CREATE TABLE clientes (
id int PRIMARY KEY AUTO_INCREMENT,
    nome varchar
(250) not null,
    cpf varchar
(250) not null

);

CREATE TABLE pedidos (
id int PRIMARY KEY AUTO_INCREMENT,
  cliente_id integer REFERENCES clientes
(id),
    data DATe not null,
   status enum
('Aberto','Pago','Cancelado')
    
);

CREATE TABLE produtos (
id int PRIMARY KEY AUTO_INCREMENT,
    nome varchar
(250) not null,i
    valor double not null
);


CREATE TABLE itens_pedidos (
id int PRIMARY KEY AUTO_INCREMENT,
    produto_id integer REFERENCES produtos
(id),
    quantidade integer not null,
    valor_unitario double,
    valor_total double,
    pedido_id integer REFERENCES pedidos
(id)

);





SELECT ip.*, produto.nome as nome_produto, cliente.nome as nome_cliente, p.data, p.status 
        FROM intens_pedidos as ip
            INNER JOIN produtos as pro on pro.id = ip.produto_id
            INNER JOIN pedidos as p on p.id = ip.pedido_id
            INNER JOIN clientes as cli on cli.id = p.cliente_id
        ;

DELETE p FROM pedidos p 
LEFT OUTER JOIN itens_pedidos ip ON p.id = ip.pedido_id
WHERE ip.pedido_id = 2