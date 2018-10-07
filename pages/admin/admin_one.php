<?php
// Получаем информацию о товаре из базы.
$arrProduct = getProduct($id);

// Получаем список фотографий данного товара.
$arrProductImg = getProductImg($arrProduct['id_prod']);

// Проверяем была ли нажата кнопка Добавить в корзину.
if ($_REQUEST['prod']['submitEdit']) {
  // Добавляем данные в базу.
  editProduct(['id_prod' => $_POST['prod']['id_prod'],
                'name' => $_POST['prod']['name'],
                'text' => $_POST['prod']['text'],
                'price' => $_POST['prod']['price']]);
  // Делаем редирект.
  header("Location: " . $_SERVER['REQUEST_URI']);
  exit;
}

// Подключаем html страницу с полным описание товара.
echo render("admin_one",
            ['arrProduct' => $arrProduct, 'arrProductImg' => $arrProductImg, 'title' => 'Подробное описание товара']);