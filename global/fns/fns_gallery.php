<?php
/**
 * Функция получает сведения о загружаемом изображении и вставляет их в базу.
 * @param string $file_name - Имя загружаемого файла.
 * @param int $id_prod - ID продукции.
 */
function setImageDB($file_name, $id_prod) {
  // Экранируем специальные символы.
  $file_name = my_string($file_name);

  // Проверяем наличие фотографий для этого продукта, если нет, то добавляем основную превьюшку.
  $resAmount = my_query("select id_img from catalog_img where id_prod = '{$id_prod}'");
  if (mysqli_num_rows($resAmount) == 0) {
    my_query("update catalog set img = '{$file_name}' where id_prod = '{$id_prod}'");
  }

  // Вставляем данные в базу.
  my_query("insert into catalog_img (id_prod, img) values ('{$id_prod}', '{$file_name}')");
}

/**
 * Функция возвращет информацию о всех фотографиях в базе данных.
 * @return array|null Для каждой фотографии получаем информацию по id_img, name, path, count в виде ассоциатвиного массива.
 */
function getAllImagesDB() {
  $result = my_query("select id_img, name, path, count from images order by count desc");
  // Извлекаем данные и возвращаем их.
  return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Функция возвращает информацию о конкретной информации по заданному id.
 * @param int $id - ID фотографии, информацию о которой хотим получить.
 * @return array|null Получаем id_img, name, path, count в виде ассоциативного массива.
 */
function getImageDB($id) {
  $result = my_query("select id_img, name, path, count from images where id_img='{$id}'");
  // Извлекаем данные и возвращаем их.
  return mysqli_fetch_assoc($result);
}

/**
 * Функция изменяет количество просмотров фотографии в базе данных.
 * @param int $id - ID фотографии, информацию о которой хотим получить.
 */
function updateCount($id) {
  // Обновляем количество просмотров фотографии в базе данных.
  my_query("update images set count = count + 1 where id_img = '{$id}'");
}
