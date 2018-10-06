<?php
/**
 * Функция утанавливает новое соединение с сервером MySQL, если оно небыло установлено ранее.
 * в противном случае выводи сообщение об ошибке.
 * @return mysqli Возвращает объект, представляющий подключение к серверу MySQL (Идентификатор соединения).
 */
function my_connect() {
  static $connect = null;
  if (is_null($connect)) {
    $connect = mysqli_connect(HOST_MySQL, LOGIN_MySQL, PASS_MySQL, NAME_DB);
    // Если не удалось установить соединение выводим сообщение об ошибке.
    if (mysqli_connect_errno()) {
      exit("Ошибка: Не удалось установить соединение с базой данных. Повторите попытку позже.");
    } else {
      @mysqli_set_charset($connect, "utf8");
    }
  }
  return $connect;
}

/**
 * Функция выполняет запрос к базе данных, в случае возникновения ошибки запроса выводится сообщение об ошибке.
 * @param $query - Текст запроса.
 * @return bool|mysqli_result  В случае успешного выполнения запросов SELECT, SHOW, DESCRIBE или EXPLAIN mysqli_query()
 * вернет объект mysqli_result. Для остальных успешных запросов mysqli_query() вернет TRUE.
 */
function my_query($query) {
  // Если возникла ошибка запроса в базу данных, то выводим сообщение об ошибке.
  if (!$result = mysqli_query(my_connect(), $query)) {
    exit("Ошибка: Ошибка запроса в базу данных. Повторите попытку позже.");
  }
  return $result;
}

/**
 * Функция экранирует специальные символы в строке для использования в SQL выражении,
 * используя текущий набор символов соединения
 * @param $value - Строка, которую требуется экранировать.
 * @return string Возвращает экранированную строку.
 */
function my_string($value) {
  // Экранируем специальные символы.
  $result = mysqli_real_escape_string(my_connect(), $value);
  return $result;
}

/**
 * Функция возвращает автоматически генерируемый ID, используя последний запрос
 * @return int|string Значение поля AUTO_INCREMENT, которое было затронуто предыдущим запросом.
 * Возвращает ноль, если предыдущий запрос не затронул таблицы, содержащие поле AUTO_INCREMENT.
 */
function my_insert_id() {
  // Получаем поледний ID.
  if (!$result = mysqli_insert_id(my_connect())) {
    exit("Ошибка: Ошибка получения последнего id. Повторите попытку позже.");
  }
  return $result;
}