<?php
// Начинаме сеанс.
session_start();

// Вычисляем количество тотваров в корзине.
define("AMOUNT_BASKET", getAmountBasket());

// Если была нажата кнопка Выйти завершаем текущую сессию.
isLogout();