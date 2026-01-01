<?php

namespace WCLS;

class Plugin {

  private static $instance = null;

  public static function instance() {
    if ( self::$instance === null ) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  private function __construct() {
    $this->includes();
    $this->init_hooks();
  }

  private function includes() {
    require_once WCLS_PATH . "includes/class-points-manager.php";
    require_once WCLS_PATH . "includes/class-admin-settings.php";
  }

  private function init_hooks() {
    new Points_Manager();
    new Admin_Settings();
  }

}