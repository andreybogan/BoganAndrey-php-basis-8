<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Получаем данные из ajax запроса.
  $id_order = $_POST['id_order'];

  // Изменяем статус заказа в базе.
  if (my_query("update orders set status = 'cancelled' where id_order = '{$id_order}'")) {
    $success = 'ok';
  } else {
    $success = 'error';
  }
  // Кодируем и делаем вывод.
  echo json_encode(['success' => $success, 'message' => 'заказ отменен']);
}