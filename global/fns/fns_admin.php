<?php
/**
 * Функция получает список товаров из базы и возвращает его.
 * @return array|null Возвращается список товаров в виде ассоциативного массива.
 */
function getCatalogAdmin() {
  // Извлекаем данные из двух таблиц с использованием подзапросов.
  $conn = my_query("select id_prod, name, price, img, hide from catalog");
  // Получаем ассоциативный массив комментариев и возвращаем его.
  return mysqli_fetch_all($conn, MYSQLI_ASSOC);
}

/**
 * Функция добавляет в базу изменненые данные в описании товара.
 * @param array $arr Массив параметров из формы.
 */
function editProduct($arr){
  // Экранируем специальные символы.
  $id_prod = my_string($arr['id_prod']);
  $name = my_string($arr['name']);
  $text = my_string($arr['text']);
  $price = my_string($arr['price']);
  // Обновляем данные о товаре в базе.
  my_query("update catalog set name = '{$name}', text = '{$text}', price = '{$price}' where id_prod = '{$id_prod}'");
}

/**
 * Функция добавляет в базу новый товар.
 * @param array $arr Массив параметров из формы.
 */
function addProd($arr){
  // Экранируем специальные символы.
  $name = my_string($arr['name']);
  $text = my_string($arr['text']);
  $price = my_string($arr['price']);
  // Добавляем товар в базу.
  my_query("insert into catalog (name, text, price) values ('{$name}', '{$text}', '{$price}')");
}