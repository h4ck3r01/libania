select * from pessoas where id='7';

select * from fiado_pessoas where pessoa_id='7';

SELECT a.*, b.total AS fiado_total
FROM (SELECT a.pessoa_id, (a.vendas - IFNULL(b.recebimentos, 0)) AS total
      FROM (SELECT a.pessoa_id, sum(a.total) AS vendas
            FROM vendas a
            WHERE a.pessoa_id IS NOT NULL
            GROUP BY a.pessoa_id) a
           LEFT JOIN (SELECT b.pessoa_id, sum(b.total) AS recebimentos
                      FROM recebimentos b
                      WHERE b.pessoa_id IS NOT NULL
                      GROUP BY b.pessoa_id) b
              ON a.pessoa_id = b.pessoa_id) a,
     fiado_pessoas    b
WHERE a.pessoa_id = b.pessoa_id AND a.total != b.total;