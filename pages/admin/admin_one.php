<?php
// Проверяем была ли нажата кнопка Добавить в корзину.
if ($_REQUEST['prod']['submitEdit']) {
  // Добавляем данные в базу.
  editProduct(['id_prod' => $_POST['prod']['id_prod'],
                'name' => $_POST['prod']['name'],
                'text' => $_POST['prod']['text'],
                'price' => $_POST['prod']['price']]);
  // Делаем редирект.
  header("Location: " . $_SERVER['REQUEST_URI']);
  exit;
}

// Каталог для хранения превьюшек фотографий.
$dirImgSmall = "images/small/";
// Каталог для хранения оригиналов фотографий.
$dirImgBig = "images/big/";
// Загружаемый файл.
$file = 'file';

// Если была нажата кнопка Добавить фото, то обрабатываем его.
if (@$_REQUEST['uploadPhoto']) {
  // Загружаем фото.
  $result = uploadFiles($dirImgBig, $dirImgSmall, $file);

  // Если при загрузке файла возникла ошибка, то выводим ее, иначе добавляем информацию в базу.
  if ($result['error']) {
    // Выводим сообщение об ошибке.
    echo "При загрузке файла возникла проблема: {$result['error']}";
  } else {
    // Формируем url адрес картинки.
    $urlImages = "http://" . $_SERVER['HTTP_HOST'] . "/" . $dirImgBig . $result['file_name'];
    // Заносим информацию о загруженном изображении в базу.
    setImageDB($result['file_name'], $_POST['id_prod']);
    // Редирект на саму себя.
    header("Location:  http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    exit;
  }
}

// Получаем информацию о товаре из базы.
$arrProduct = getProduct($id);

// Получаем список фотографий данного товара.
$arrProductImg = getProductImg($arrProduct['id_prod']);

// Получаем массив картинок из базы данных.
//$arrSmallImages = getAllImagesDB();

// Подключаем html страницу с полным описание товара.
echo render("admin_one",
            ['arrProduct' => $arrProduct, 'arrProductImg' => $arrProductImg, 'title' => 'Подробное описание товара']);