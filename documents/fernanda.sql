SELECT a.id                     AS codigo_produto,
       a.nome                   AS produto,
       b.data                   AS data_venda,
       a.compra                 AS preco_custo,
       (a.preco * c.quantidade) AS preco_venda,
       a.preco                  AS preco_unitario,
       c.quantidade             AS quantidade_venda
FROM produtos a, vendas b, venda_produtos c
WHERE a.id = c.produto_id AND c.venda_id = b.id;

VENDA X PRODUTO

SELECT a.id         AS codigo_produto,
       a.nome       AS produto,
       d.nome       AS categoria,
       b.data       AS data,
       c.quantidade AS quantidade,
       c.total      AS preco
FROM produtos a, vendas b, venda_produtos c, produto_categorias d
WHERE a.id = c.produto_id AND c.venda_id = b.id;

#RELACAO VENDAS


SELECT A.id,
       A.nome,
       C.nome                                     AS categoria,
       A.venda_quantidade,
       a.venda_total,
       b.compra_quantidade,
       b.compra_total,
       (b.compra_quantidade - a.venda_quantidade) estoque,
       (a.venda_total - b.compra_total)           AS lucro
FROM (SELECT produtos.id,
             produtos.nome,
             produtos.categoria_id,
             IFNULL(sum(venda_produtos.quantidade), 0)   AS venda_quantidade,
             IFNULL(sum(venda_produtos.total), 0)        AS venda_total
      FROM `produtos`
           LEFT JOIN
           (SELECT venda_produtos.*, vendas.data AS data
            FROM venda_produtos, vendas
            WHERE     venda_produtos.produto_id = vendas.id
                  AND vendas.`data` BETWEEN '2018-01-01'
                                        AND '2018-07-01') venda_produtos
              ON `venda_produtos`.`produto_id` = `produtos`.`id`
      GROUP BY produtos.id, produtos.nome, produtos.categoria_id) A,
     (SELECT produtos.id,
             IFNULL(sum(compra_produtos.quantidade), 0)
                AS compra_quantidade,
             IFNULL(sum(compra_produtos.total), 0)   AS compra_total
      FROM `produtos`
           LEFT JOIN
           (SELECT compra_produtos.*, compras.vencimento AS vencimento
            FROM compra_produtos, compras
            WHERE     compra_produtos.produto_id = compras.id
                  AND compras.`vencimento` BETWEEN '2018-01-01'
                                               AND '2018-07-01')
           compra_produtos
              ON `compra_produtos`.`produto_id` = `produtos`.`id`
      GROUP BY produtos.id, produtos.nome, produtos.categoria_id) B,
     `produto_categorias`    C
WHERE A.ID = B.ID AND A.categoria_id = C.id;

#RELACAO PRODUTOS


SELECT a.id                AS codigo_produto,	
       a.nome              AS produto,
       c.nome              AS categoria,
       b.total             AS quantidade,
       (a.preco * b.total) AS total
FROM produtos a, estoque_produtos b, produto_categorias c
WHERE a.id = b.produto_id AND a.categoria_id = c.id;

#BALANÇO

select * from venda_produtos a, produtos b where a.produto_id = b.id;
