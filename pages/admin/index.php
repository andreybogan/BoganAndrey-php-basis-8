<?php
// Проверяем была ли нажата кнопка Добавить в корзину.
if ($_REQUEST['prod']['submitAddProd']) {
  // Добавляем данные в базу.
  addProd(['name' => $_POST['prod']['name'],
            'text' => $_POST['prod']['text'],
            'price' => $_POST['prod']['price']]);
  // Делаем редирект.
  header("Location: " . $_SERVER['REQUEST_URI']);
  exit;
}

// Получаем массив товаров из базы.
$arrCatalog = getCatalogAdmin();

// Подключаем html страницу каталога.
echo render("admin", ['arrCatalog' => $arrCatalog, 'title' => 'Каталог товаров']);