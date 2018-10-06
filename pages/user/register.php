<?php
// Проверяем нажата ли кнопка Зарегистрироваться.
if ($_REQUEST['reg']['submit']) {
  // Создаем короткие имена переменых.
  $login = $_POST['reg']['login'] ?? '';
  $name = $_POST['reg']['name'] ?? '';
  $pass = $_POST['reg']['pass'] ?? '';

  // Проверяем корректность заполнения формы.
  if (empty($errors = checkRegForm($_POST['reg'], $login, $pass, true))) {
    // Добавляем регистрационную информацию в базу данных.
    addRegInfo($login, $pass, $name);
    // Регистрируем идентификатор пользователя.
    $_SESSION['user'] = $login;
    // Добавляем в $_SESSION['userInfo'] информацию о пользователе: id и имя пользователя, для быстрого доступа.
    addInfoInSession($login);
    // Делаем переадресацию на страницу пользователя.
    header("Location: ../user");
    exit;
  };
}

// Подключаем html страницу корзины.
echo render("register",
            ['arrProdInBasket' => $arrProdInBasket, 'errors' => $errors, 'login' => $login, 'pass' => $pass,
              'name' => $name, 'title' => 'Регистрация пользователя']);