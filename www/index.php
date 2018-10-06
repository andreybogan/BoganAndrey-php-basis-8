<?php
header("Content-type: text/html; charset=utf-8");

// Поключаем файлы конфигурации и функции.
require __DIR__ . "/../global/config.php";
require GLOBAL_DIR . "fns/autoload.php";
require GLOBAL_DIR . "onload.php";

$path = $_SERVER['REQUEST_URI'];

if (!$path = preg_replace(["#^/#", "#[?].*#"], "", $_SERVER['REQUEST_URI'])) {
  $path = "catalog";
};

$parts = explode("/", $path);
$page = $parts[0];
$action = $parts[1] ?? "index";
$id = $parts[2] ?? "";

$pageName = PAGES_DIR . $page . "/" . $action . ".php";
if (file_exists($pageName)) {
  include $pageName;
} else {
  echo "Такой страницы нет!";
}