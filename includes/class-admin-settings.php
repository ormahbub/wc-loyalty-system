<?php

namespace WCLS;

class Admin_Settings {
  
  public function __construct() {
    add_action( "admin_menu", [ $this, "menu" ] );
    add_action( "admin_init", [ $this, "settings" ] );
  }

  public function menu() {
    add_submenu_page(
      "woocommerce",
      "Loyalty Settings",
      "Loyalty Settings",
      "manage_woocommerce",
      "wcls-settings",
      [$this, "settings_page"]
    );
  }

  public function settings() {
    register_setting( "wcls_settings", "wcls_points_rate" );

    add_settings_section(
      "wcls_main",
      "General Settings",
      null,
      "wcls-settings"
    );

    add_settings_field(
      "wcls_points_rate",
      "Points per 1 currency",
      [ $this, "rate_field" ],
      "wcls-settings",
      "wcls_main"
    );

  }

  public function rate_field() {
    $value = get_option( "wcls_points_rate", 1 );
    echo('<input type="number" step="0.1" name="wcls_points_rate" value="' . esc_attr( $value ) . '">');
  }




  public function settings_page() {
    ?>
    <div class="wrap">
      <h1>Loyalty Settings</h1>
      <form method="post" action="options.php">
        <?php
        settings_fields( "wcls_settings" );
        do_settings_sections( "wcls-settings" );
        submit_button();
        ?>
      </form>

      <div style="margin-top: 20px; padding: 15px; background: #fff; border-left: 4px solid #2271b1; box-shadow: 0 1px 1px rgba(0,0,0,.04);">
        <strong>Current Points Rate:</strong> 
        <?php echo esc_html( get_option( "wcls_points_rate", "1" ) ); ?>
      </div>
    </div>
    <?php
  }

}