<?php
//////////ВЫВОД ВСЕХ КАТЕГОРИЙ/////////////
	

function get_categories(): array{
    global $pdo;
    $res = $pdo -> query("SELECT 
    c.section_id, c.heading,
     COUNT(IFNULL(mc.product_id, spc.product_id)) AS count_products
   FROM
     categories c 
     LEFT JOIN 
       main_categories mc 
         ON c.section_id = mc.categories_section_id
     LEFT JOIN
       secondary_product_category spc
         ON c.section_id = spc.categories_section_id
     LEFT JOIN
       product p ON IFNULL(mc.product_id, spc.product_id) = p.product_id
   WHERE
     p.availability = 1
   GROUP BY
     c.section_id
     ORDER BY count_products DESC;");
     return $res -> fetchAll();
}