<?php 
////////страница товаров в категории//////////////
    error_reporting(-1);
    require_once __DIR__ .'/vendor/connect.php';
    require_once __DIR__ .'/vendor/funcs.php';
    require_once __DIR__ .'/vendor/category_funks.php';
    require_once __DIR__ .'/vendor/product_funks.php';


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="card.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
<?php if (!empty($category)): ?>
    <title><? echo $category[0]['heading']; ?></title>
</head>
<body>
    <div class="back"><a class="btn_back" href="index.php">Назад</a></div>

<div class="block">
    <?php foreach ($category as $cat ): ?>
        <p class="data">6 Nov 2017</p>
        <h1><?= $cat['heading']?></h1>
        <p class="text">Здесь представлены все товары категории: <?= $cat['description']?></p>
        <?php endforeach; ?>
        <?php  endif; ?>
    </div>
    <div class="container">
        <?php if (!empty($products)): ?>
        <?php foreach ($products as $product ): ?>
           
        <div class="card1">
        <a href="product.php?id=<?= $product['product_id']?>">
            <img src="<?= $product['link']?>" alt="<?= $product['alt']?>">
            <div class="card1_label">
                <p>
                <?= $product['heading']?>
                </p>
            </div>
            </a>
        </div>
        <?php endforeach; ?>
        <?php  endif; ?>
      </div>
      <footer> 
        <div class="nav"> 
            <div class="page"> 
                <?php 
                    $queries = []; 
                    parse_str($_SERVER['QUERY_STRING'], $queries); 
 
                    for ($i = 1; $i <= $str_pag; $i++): 
                        $queries['page'] = $i; 
                        $query_string = http_build_query($queries); 
                        echo "<a href=category.php?{$query_string}> Страница ".$i." </a>"; 
                    endfor; 
                ?> 
            </div> 
        </div> 
    </footer>
</body>
</html>