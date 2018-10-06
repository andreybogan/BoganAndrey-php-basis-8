<?php
/**
 * Функция возвращает массив заказов для активного пользователя.
 * @return array|null Возвращает ассоциативный массив заказов, если заказы отсутствуют возвращет null.
 */
function getOrders() {
  $result =
    my_query("select id_order, date, address, total, status from orders 
              where id_user = '{$_SESSION['userInfo']['id_user']}'");
  return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Если была нажата кнопка Заказать, то формируется заказа и добавляется в базу.
 */
function isSubmitAddOrder() {
// Проверяем была ли нажата кнопка Удалить из корзины.
  if ($_REQUEST['submitAddOrder']) {
    // Получаем данные из формы.
    $totalPriceBasket = my_string($_POST['totalPriceBasket']);
    $address = my_string($_POST['address']);

    // Получаем массив товаров в корзине.
    $arrAllProdBasket = getAllProdBasket();

    // Получаем текущее время.
    $time = time();

    // Добавляем данные заказа в таблицу orders.
    my_query("insert into orders (id_user, date, address, total) 
              values ('{$_SESSION['userInfo']['id_user']}', '{$time}', '{$address}', '{$totalPriceBasket}')");

    // Получаем id добавленного заказа.
    $lastInsertID = my_insert_id();

    // Обходим в цикле все товары в корзине и добавляем их в таблицу order_items.
    foreach ($arrAllProdBasket as $value) {
      my_query("insert into order_items (id_order, id_prod, item_price, quantity, name) 
                values ('{$lastInsertID}', '{$value['id_prod']}', '{$value['price']}', '{$value['amount']}', '{$value['name']}')");
    }

    // Очищаем корзину.
    cleanBasket($_SESSION['userInfo']['id_user']);

    // Делаем редирект.
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
  }
}