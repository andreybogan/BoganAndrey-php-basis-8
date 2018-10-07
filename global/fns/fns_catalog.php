<?php
/**
 * Функция получает список товаров из базы и возвращает его.
 * @return array|null Возвращается список товаров в виде ассоциативного массива.
 */
function getCatalog() {
  // Извлекаем данные из двух таблиц с использованием подзапросов.
  $conn = my_query("select id_prod, name, price, img, hide from catalog where hide = 'see'");
  // Получаем ассоциативный массив комментариев и возвращаем его.
  return mysqli_fetch_all($conn, MYSQLI_ASSOC);
}

/**
 * Функция получает информацию о конкретном товаре из базы и возвращает ее.
 * @param int $id - id конкретного товара.
 * @return array|null Возвращаются данные о товаре в виде ассоциативного массива.
 */
function getProduct($id) {
  // Делаем запрос в базу.
  $conn = my_query("select * from catalog where id_prod = '{$id}'");
  // Возвращам результат.
  return mysqli_fetch_assoc($conn);
}

/**
 * Функция получает список фотографий товара из базы и возвращает его.
 * @param int $id - id конкретного товара.
 * @return array|null Возвращается список фотографий конкретного товара в виде ассоциативного массива.
 */
function getProductImg($id) {
  // Делаем запрос в базу.
  $conn = my_query("select img from catalog_img where id_prod = '{$id}'");
  // Возвращам результат.
  return mysqli_fetch_all($conn, MYSQLI_ASSOC);
}