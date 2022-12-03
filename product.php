<?php 
//////////страница продукта/////////////
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
    <link rel="stylesheet" href="style.css">
   
    <link href = "font/stylesheet.css" rel = "stylesheet" type = "text/css" />
    <?php if ((!empty($item)) &&(!empty($images)) &&(!empty($cates))): ?>
    <title><? echo $item['heading']; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
</head>
<body>
<div class="back"><a class="btn_back" href="category.php?cat=<?=$_COOKIE["cat"]?>">Назад</a></div>
    <div class="main">
   
    <div class="container">
        <div class="images">
            <div class="imagas_all">
                <a href="<?= $images[0]['main_img']?>">
                    <img  class="small_pic" id="smal_1" src="<?= $images[0]['main_img']?>" alt="<?= $it['alt_for_sec']?>">
                </a>
            <?php foreach ($images as $it ): ?>
                <a href="<?= $it['sec_img']?>">
                    <img  class="small_pic" id="smal_1" src="<?= $it['sec_img']?>" alt="<?= $it['alt_for_sec']?>">
                </a>
                <?php endforeach  ?>    
            </div>
            <div class="imagas_one">
                <img class="big" src="<?= $images[0]['main_img']?>" alt="" style="width: 340px; height:492px; margin-top: 30px; margin-left: 20px;" >
            </div>
        </div>
        <div class="product">
            <div class="product_name"><H2><?= $item['heading']?></H2></div>
            <div class="product_category">
            <?php foreach ($cates as $ca ): ?>
                <a href="category.php?cat=<?= $ca['section']?>"><?= $ca['category']?></a>
                
                <?php endforeach  ?>    
            </div>
            <div class="product_price">
                <div class="product_price_nopromo">
                    <span class="product_price_old"><?= $item['full_price']?></span> 
                    <span class="product_price_actual"> <?= $item['promo_price']?> <span class="rub">Р</span></span>

                    </div>
                <div class="product_price_promo"><?= $item['price']?> <span class="rub">Р</span> <span> - с промокодом</span></div>
            </div>
            <div class="product_shop">
                <div class="product_shop_text">
                    <img class="check" src="check.png" alt=""> В наличии в магазине 
                    <a href="">Lamoda</a> </div>
                <div class="product_shop_text">
                    <img src="truck.png" alt=""> Бесплатная доставка </div>
            </div>
            <div class="product_count">
                <button id="buttonCountMinus" class="product_count_minus">-</button>
                <input id="CountNumber" type="number" value="1" disabled>
                <button id="buttonCountPlus" class="product_count_plus">+</button>
            </div>
            <div class="product_btn">
                <button id="myBtn" onclick="success()" class="product_btn_buy">Купить</button>
                <button class="product_btn_add">В избранное</button>
            </div>
            <div class="product_info"><p><?= $item['descripiton']?></p></div>
            <div class="product_shere">
                <div class="product_shere_text">Поделиться:</div>
                <div class="product_shere_icon">
                    <a href="">
                        <img  class="vk" src="B.png" alt="">
                    </a>
                    <a href="">
                        <img src="google.png" alt="">
                    </a>
                    <a href="">
                        <img class="facebook" src="fbook.png" alt="">
                    </a>
                    <a href="">
                        <img class="twitter" src="twit.png" alt="">
                    </a>                    
                </div>
                <div class="square" href="">
                    123
                </div> 
            </div>
        </div>
    </div>
    <?php  endif; ?>
</div>        
            <!-- JS -->
<script type="text/javascript" src="scripts.js"></script>

</body>
</html>