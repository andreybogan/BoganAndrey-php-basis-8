<?php
// Получаем информацию о товаре из базы.
$arrProduct = getProduct($id);

// Получаем список фотографий данного товара.
$arrProductImg = getProductImg($arrProduct['id_prod']);

// Проверяем была ли нажата кнопка Добавить в корзину.
if ($_REQUEST['submitAddBasket']) {
  // Добавляем данные в базу.
  addProdToBasket($_POST['id_prod']);
  // Делаем редирект.
  header("Location: " . $_SERVER['REQUEST_URI']);
  exit;
}

// Подключаем html страницу с полным описание товара.
echo render("catalog_one",
            ['arrProduct' => $arrProduct, 'arrProductImg' => $arrProductImg, 'title' => 'Подробное описание товара']);