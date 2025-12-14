<?php

namespace Numa\Tasks;

class View {

  public static function render($template, $data = []) {
    extract($data);

    require self::getBasePath().$template.'.php';
  }

  public static function getBasePath() {
    return dirname(__DIR__).'/public/templates/';
  }

}