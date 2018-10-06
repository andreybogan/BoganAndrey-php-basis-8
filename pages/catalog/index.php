<?php
// Проверяем была ли нажата кнопка Добавить в корзину.
if ($_REQUEST['submitAddBasket']) {
  // Добавляем данные в базу.
  addProdToBasket($_POST['id_prod']);
  // Делаем редирект.
  header("Location: " . $_SERVER['REQUEST_URI']);
  exit;
}

// Получаем массив товаров из базы.
$arrCatalog = getCatalog();

// Подключаем html страницу каталога.
echo render("catalog", ['arrCatalog' => $arrCatalog, 'title' => 'Каталог товаров']);