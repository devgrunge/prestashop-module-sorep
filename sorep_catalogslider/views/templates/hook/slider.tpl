

<!DOCTYPE html>
<html>
<head>
{*<link rel="stylesheet" href="../../css/sorep_catalogslider.css" />*}
<title>Catalog Slider</title>
</head>
<body>
<h1 class="catalog-carousel-title">Catálogos</h1>
 {$acessory_data|dump}
<ul class="side-by-side-list">
<li class="products-list">
<div class="background-family-carousel"> 
<img class="product-example-carousel" src"{$link->getCatImageLink($cat['link_rewrite'], $cat['id_category'])}" alt="Product example" />
<h4 class="product-type-title">Parafusos 2020</h4>
<h6 class="product-type-subtitle">Brandenburguer</h6>
</div>
</li>
<li class="products-list">
<div class="background-family-carousel"> 
<img class="product-example-carousel" src"" alt="Product example" />
<h4 class="product-type-title">Parafusos 2020</h4>
<h6 class="product-type-subtitle">Brandenburguer</h6>
</div>
</li>
<li class="products-list">
<div class="background-family-carousel"> 
<img class="product-example-carousel" src"" alt="Product example" />
<h4 class="product-type-title">Parafusos 2020aaaa</h4>
<h6 class="product-type-subtitle">Brandenburguer</h6>
</div>
</li>
<li class="products-list">
<div class="background-family-carousel"> 
<img class="product-example-carousel" src"" alt="Product example" />
<h4 class="product-type-title">Parafusos 2020</h4>
<h6 class="product-type-subtitle">Brandenburguer</h6>
</div>
</li>
<li class="products-list">
<div class="background-family-carousel"> 
<img class="product-example-carousel" src"" alt="Product example" />
<h4 class="product-type-title">Parafusos 2020</h4>
<h6 class="product-type-subtitle">Brandenburguer</h6>
</div>
</li>
</ul>



{foreach $custdata as $item}
  {$item.id_product_1}:{$item.id_product_2}
{/foreach}
{*<div class="background-family-carousel"> 
<img class="product-example-carousel" src"" alt="Product example" />
</div>
<h4 class="product-type-title">Parafusos 2020</h4>
<h6 class="product-type-subtitle">Brandenburguer</h6>*}


</body>
</html>