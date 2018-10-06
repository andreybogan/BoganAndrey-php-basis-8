<?php
// Проверяем нажата ли кнопка Войти.
if ($_REQUEST['login']['submit']) {
  // Создаем короткие имена переменых.
  $login = $_POST['login']['login'] ?? '';
  $pass = $_POST['login']['pass'] ?? '';

  // Проверяем корректность заполнения формы.
  if (empty($errors = checkRegForm($_POST['login'], $login, $pass))) {
    // Проверяем существует ли в базе пользователем с полученным именем пользователя и паролем.
    if (isAuth($login, $pass)) {
      // Регистрируем идентификатор пользователя.
      $_SESSION['user'] = $login;
      // Добавляем в $_SESSION['userInfo'] информацию о пользователе: id и имя пользователя, для быстрого доступа.
      addInfoInSession($login);
      // Делаем переадресацию на страницу пользователя.
      header("Location: ../user");
      exit;
    } else {
      $errors[] = "Неправильное имя пользователя или пароль.";
    }
  }
}

// Подключаем html страницу корзины.
echo render("login", ['errors' => $errors, 'title' => 'Вход на сайт']);