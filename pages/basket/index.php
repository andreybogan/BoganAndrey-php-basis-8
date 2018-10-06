<?php
// Получаем массив товаров в корзине.
$arrProdInBasket = getAllProdBasket();

// Вычисляем общую сумму заказа.
$totalPriceBasket = getTotalPriceBasket($arrProdInBasket);

// Если нажата кнопка Добавить, то добавляем товар в корзину.
isSubmitAddBasket();

// Если нажата кнопка Удалить, то удаляем товар из корзины.
isSubmitRemoveBasket();

// Подключаем html страницу корзины.
echo render("basket", ['arrProdInBasket' => $arrProdInBasket, 'totalPriceBasket' => $totalPriceBasket, 'title' => 'Корзина']);