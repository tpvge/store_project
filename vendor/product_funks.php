<?php
  ///////////ВЫВОД ТОВАРА///////////
  require_once __DIR__ .'/funcs.php';

$id = 13;
if (isset($_GET['id'])){   ///get запрос на id товара
    $id = intval($_GET['id']);//приводим get параметр к типу int для защиты от xss
}



$prod= get_id($id);
function get_id($id): array{ //проверяем есть ли вообще такая категория 
    global $pdo;
    $where_id=13;
     $where_id = " p.product_id = $id ";
    $res = $pdo -> query("SELECT DISTINCT count(p.product_id) as product
FROM
    product p
WHERE
    $where_id");
   
    return $res -> fetch();
}

if ($prod['product']==0){ //если записей 0 то 404
  die("Запрашиваемая страница не найдена");
}


$item = get_name($id);   
function get_name($id): array{      //получение информации о товаре(название, цены, описание)
    
    global $pdo;

    $where_id=13;
     $where_id = " p.product_id = $id ";
    $res = $pdo -> query("SELECT DISTINCT
    p.heading,
    price,
    full_price,
    promo_price,
    descripiton    
FROM
    product p
WHERE
    $where_id");
     return $res -> fetch();

}

$cates = get_cates($id);
if(empty($_COOKIE["cat"])){
    setcookie("cat", $cates[0]['section']);
}

function get_cates($id): array{//получение информации о товаре(категории)
    
    global $pdo;

    $where_id=13;
     $where_id = " p.product_id = $id ";
     $res = $pdo -> query("SELECT DISTINCT
         c.heading AS category, c.section_id as section
     FROM
         product p
             LEFT JOIN
         main_categories mc ON p.product_id = mc.product_id
             LEFT JOIN
         secondary_product_category sc ON p.product_id = sc.product_id
             LEFT JOIN
         categories c ON (mc.categories_section_id = c.section_id
             OR sc.categories_section_id = c.section_id)
            
     WHERE
         $where_id");
     return $res -> fetchAll();
}

$images = get_images($id);
function get_images($id): array{//получение информации о товаре(картинки)
    
    global $pdo;

    $where_id=13;
     $where_id = " p.product_id = $id ";
     $res = $pdo -> query("SELECT DISTINCT
         i.link AS main_img,
         i.alt AS alt_for_main,
         im.link AS sec_img,
         im.ALT AS alt_for_sec
     FROM
         product p
             LEFT JOIN
         main_product_image mpi ON p.product_id = mpi.product_id
             LEFT JOIN
         secondary_product_image spi ON p.product_id = spi.product_id
             LEFT JOIN
         image i ON i.image_id = mpi.image_id
             LEFT JOIN
         image im ON im.image_id = spi.image_id
     WHERE
         $where_id ");
     return $res -> fetchAll();
}