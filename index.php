<?php 
//////////страница категорий//////////
    error_reporting(-1);
    require_once __DIR__ .'/vendor/connect.php';
    require_once __DIR__ .'/vendor/category_funks.php';
    require_once __DIR__ .'/vendor/categories_funks.php';
    $categories = get_categories();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sec.css">
    <title>Категории</title>
</head>
<body>
    <div class="container">
        <div class="title"><h1>Категории товаров</h1></div>
        <div class="categories">
                 <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category ): ?>
                       <a href="category.php?cat=<?= $category['section_id']?>"> <?= $category['heading']?> - <span><?= $category['count_products']?> шт.</span></a> <br><br>
                    <?php endforeach; ?>
                    <?php  endif; ?>
            
        </div>
    
    </div> 
   
  
</body>
</html>