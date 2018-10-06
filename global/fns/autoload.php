<?php
function autoload() {
  $files = scandir(GLOBAL_DIR . "fns");
  foreach ($files as $file) {
    if (!in_array($file, ['.', '..'])) {
      if (substr($file, -4) == ".php") {
        require_once GLOBAL_DIR . "fns" . DIRECTORY_SEPARATOR . $file;
      }
    }
  }
}

autoload();