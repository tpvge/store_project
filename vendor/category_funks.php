<?php
  /////////ФУНКЦИИ ДЛЯ СТРАНИЦЫ ВЫВОДА ТОВАРОВ В КАТЕГОРИИ///////////////
  require_once __DIR__ .'/funcs.php';
  require_once __DIR__ .'/product_funks.php';
  

if (isset($_GET['page'])){ //запрос на какой странице мы находимся
    $page = $_GET['page'];
}else {
    $page = 1;
}


$cat = 1;
if (isset($_GET['cat'])){//запрос на id категории
    $cat = intval($_GET['cat']); //приводим get параметр к типу int для защиты от xss
    setcookie("cat", $cat);
}

$name= get_cat($cat);
function get_cat($cat): array{ //проверяем есть ли вообще такая категория 
  global $pdo;
  $res = $pdo -> query("SELECT  count(c.section_id) as cat
 FROM
   categories c 
  where
    c.section_id = $cat");
   
    return $res -> fetch();}

if ($name['cat']==0){ //если записей 0 то 404
  die("Запрашиваемая страница не найдена");
}




$kol = 12;  // количество записей для вывода
$art = ($page * $kol) - $kol;
$products = get_product($cat,$art, $kol);
// Определяем все количество записей в таблице
$res = get_count($cat);
$total = $res[0]['count(*)']; // всего записей

// Количество страниц для пагинации
$str_pag = ceil($total / $kol);


//////////вывод товаров///////////
function get_product( $cat,$kol,$art ): array //вывод списка товаров в определенной категории
{
    global $pdo;
    $where_cat=null;
    if (!empty($cat)) $where_cat = " and (spc.categories_section_id = $cat or mc.categories_section_id = $cat) ";
    $res = $pdo->query("SELECT 
    mc.product_id, p.heading, i.link, i.alt
   FROM
     main_categories mc 
     LEFT JOIN
       secondary_product_category spc
         ON mc.product_id = spc.product_id
     LEFT JOIN
       product p ON IFNULL(mc.product_id, spc.product_id) = p.product_id
       left join 
       main_product_image mpi on IFNULL(mc.product_id, spc.product_id) = mpi.product_id
       left join 
       image i on mpi.image_id = i.image_id
      WHERE
     p.availability = 1  $where_cat
     limit $kol, $art");
     return $res -> fetchAll();
}
//////кол-во товаров///////////
function get_count($cat): array // подсчет количества товаров (для пагинации)
{
    global $pdo;
    $where_cat=null;
    if (!empty($cat)) $where_cat = " and (spc.categories_section_id = $cat or mc.categories_section_id = $cat) ";
    $res = $pdo -> query("SELECT 
    count(*)
   FROM
     main_categories mc 
     LEFT JOIN
       secondary_product_category spc
         ON mc.product_id = spc.product_id
     LEFT JOIN
       product p ON IFNULL(mc.product_id, spc.product_id) = p.product_id
       left join 
       main_product_image mpi on IFNULL(mc.product_id, spc.product_id) = mpi.product_id
       left join 
       image i on mpi.image_id = i.image_id
   WHERE
     p.availability = 1  $where_cat ");
     return $res -> fetchAll();
}

///////////////////////////
$category = get_category_name($cat); // вывод названия и описании категории
function get_category_name($cat): array{
    global $pdo;
    $where_cat=1;
    if (!empty($cat)) $where_cat = " section_id = $cat ";
    $res = $pdo -> query("SELECT heading, description
    from categories
    where $where_cat");
     return $res -> fetchAll();

}

