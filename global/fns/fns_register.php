<?php
/**
 * Функция проверяет правильность заполнения регистрационной формы.
 * @param array $arrPost - Массив значений полученных из формы.
 * @param mixed $login - Логин пользователя.
 * @param mixed $pass - Пароль пользователя.
 * @return array|null Возвращет массив ошибок, либо null, если ошибок нет.
 */
function checkRegForm($arrPost, $login, $pass, $unicLogin = false) {
  // Инициализируем массив для ошибок.
  $errors = null;

  // Проверяем что все значения переданные из формы имеют значения.
  if (!CheckFillForm($arrPost)) {
    $errors[] = "Заполните все поля формы.";
  } else {
    // Проверяем корректность заданного пользователем логина.
    if (!checkLogin($login, 5)) {
      $errors[] = "Логин не может быть короче 5 символов.";
    };

    // Проверяем логина на уникальность.
    if ($unicLogin === true) {
      if (checkLoginUnique($login)) {
        $errors[] = "Этот логин уже занят, попробуйте выбрать другой.";
      };
    }

    // Проверяем корректность заданного пользователем пароля.
    if (!checkPass($pass, 5)) {
      $errors[] = "Пароль содержит недопустимые символы или его длина менее 5 символов.";
    };
  }
  return $errors;
}

/**
 * Функция заносит данные пользователя в базу данных, предварительно захешировав пароль.
 * @param mixed $login - Логин пользователя.
 * @param mixed $name - Имя пользователя.
 * @param mixed $pass - Пароль пользователя.
 */
function addRegInfo($login, $pass, $name) {
  // Хешируем пароль.
  $pass = password_hash($pass, PASSWORD_DEFAULT);
  // Экранируем специальные символы.
  $login = my_string($login);

  // Добавляем информацию в базу данных.
  my_query("insert into user (login, pass, name) values ('{$login}', '{$pass}', '{$name}')");
}

/**
 * Функция проверяет была ли нажата кнопка Выйти. Если да, то удаляем текущую сессию.
 */
function isLogout() {
  if ($_REQUEST['logout']) {
    // Удаляем текующую сессию.
    logout();
    // Делаем переадресацию.
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
  }
}

/**
 * Функция удаляет текующую сессию.
 */
function logout() {
  // Очищаем данные сессии.
  $_SESSION = [];
  // Удаляем cookie, соответствующую sid.
  unset($_COOKIE[session_name()]);
  // Уничтожаем хранилище сессии.
  session_destroy();
}

/**
 * Функция проверяет существует ли в базе пользователем с полученным именем пользователя и паролем.
 * @param mixed $login - Имя пользователе.
 * @param mixed $pass - Пароль пользователя.
 * @return bool Если пользователь существует возвращает true, иначе - false.
 */
function isAuth($login, $pass) {
  // Проверяем, есть ли в базе информация по данному имени пользователя, если есть, то получаем хеш пароля.
  $result = my_query("select pass from user where login = '{$login}'");
  if ($arrUser = mysqli_fetch_assoc($result)) {
    // Проверяем, соответствует ли пароль хешу.
    if (password_verify($pass, $arrUser['pass'])) {
      return true;
    } else {
      return false;
    }
  }
  return false;
}

/**
 * Функция проверяет введенный пользователем логин на уникальность.
 * @param string $login - Логин пользователя.
 * @return bool Если логин уже существует, то возвращается true, иначе - false.
 */
function checkLoginUnique($login) {
  // Проверяем, есть ли в базе информация по данному имени пользователя, если есть, то возвращаем true.
  $result = my_query("select id_user from user where login = '{$login}'");
  if ($arrUser = mysqli_fetch_assoc($result)) {
    return true;
  }
  return false;
}

/**
 * Добавляем в $_SESSION['userInfo'] информацию о пользователе: id_user и name, для быстрого доступа.
 * @param string $login - Логин пользователя.
 */
function addInfoInSession($login) {
  // Получаем из базы информацию о пользователе.
  $result = my_query("select id_user, name from user where login = '{$login}'");
  $arrUserInfo = mysqli_fetch_assoc($result);

  // Добавляем информацию в массив.
  $_SESSION['userInfo']['id_user'] = $arrUserInfo['id_user'];
  $_SESSION['userInfo']['name'] = $arrUserInfo['name'];
}