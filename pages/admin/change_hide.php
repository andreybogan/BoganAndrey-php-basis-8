<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Получаем данные из ajax запроса.
  $id_prod = $_POST['id_prod'];
  $hide = $_POST['hide'];

  // Инициализируем переменные в зависимости от видимости товара.
  if ($hide == 'see') {
    $hide = 'hide';
    $hide_message = 'Показать';
  } else {
    $hide = 'see';
    $hide_message = 'Скрыть';
  }

  // Изменяем статус заказа в базе.
  if (my_query("update catalog set hide = '{$hide}' where id_prod = '{$id_prod}'")) {
    $success = 'ok';
  } else {
    $success = 'error';
  }
  // Кодируем и делаем вывод.
  echo json_encode(['success' => $success, 'message' => $hide_message]);
}