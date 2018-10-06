<?php
// Если нажата кнопка Добавить, то добавляем товар в корзину.
isSubmitAddOrder();

// Получаем массив заказов.
$arrOrders = getOrders();

// Подключаем html страницу корзины.
echo render("orders", ['arrOrders' => $arrOrders, 'title' => 'Заказы']);