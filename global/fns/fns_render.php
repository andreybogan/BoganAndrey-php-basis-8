<?php
/**
 * Функция отвечает за подключеие шаблонов страниц.
 * @param string $template - Имя подлключаемой страницы.
 * @param array $params - Список параметров, которые мы получаем в функции.
 */
//function renderBasket($template, $params = []) {
//  // Извлекаем переменные из массива
//  extract($params);
//  // Подключаем шаблон.
//  require TEMPLATE_DIR . $template . ".php";
//}

/**
 * Функция обертка возвращает шаблон в виде строки.
 * @param string $template - Имя подлключаемой страницы.
 * @param array $params - Список параметров, которые мы получаем в функции.
 * @param bool $useLayout - Если true, подшаблон совмещаем с шаблоном (по умолчанию true).
 * @return false|string  Возвращаем сгенерированный шаблон сайта в виде строки.
 */
function render($template, $params = [], $useLayout = true){
  // Получаем содержимое подшаблона в виде строки.
  $content = renderTemplate($template, $params);
  // Проверяем нужно ли использовать шаблон layout.
  if($useLayout){
    // Добавляем в параметры полученное содержимое подшаблона.
    $params['content'] = $content;
    // Получаем содержимое шабона в виде строки.
    $content = renderTemplate("layout/main", $params);
  }
  // Возвращаем рузультат.
  return $content;
}

/**
 * Функция генерирует шаблон и возвращает его в виде строки.
 * @param string $template - Имя подлключаемой страницы.
 * @param array $params - Список параметров, которые мы получаем в функции.
 * @return false|string Возвращаем сгенерированный шаблон в виде строки.
 */
function renderTemplate($template, $params = []){
  // Извлекаем переменные из массива
  extract($params);
  // Включаем буферизацию вывода.
  ob_start();
  // Подключаем шаблон.
  require TEMPLATE_DIR . $template . ".php";
  // Возвращаем полученное содержимое текущего буфера, бефер очищаем.
  return ob_get_clean();
}