<?php

namespace WCLS;

use WC_Order;

class Points_Manager {

  public function __construct() {
    add_action( "woocommerce_order_status_completed", [$this, "add_points" ] );
    add_action( "woocommerce_account_dashboard", [ $this, "show_points" ] );
  }

  public function add_points( $order_id ) {

    $order = wc_get_order( $order_id );
    if ( ! $order ) {
      return;
    }

    if ( $order->get_meta( "_wcls_points_added" ) === "yes" ) {
      return;
    }

    $user_id = $order->get_user_id();
    if ( ! $user_id ) {
      return;
    }

    $rate = (float) get_option( "wcls_points_rate", 1 );
    $total = (float) $order->get_total();
    $points = floor( $total * $rate );

    if ( $points <= 0 ) {
      return;
    }

    $current_points = (int) get_user_meta( $user_id, "_wcls_points", true );
    update_user_meta( $user_id, "_wcls_points", $current_points + $points );

    $order->update_meta_data( "_wcls_points_added", "yes" );
    $order->save();

  }
  
  public function show_points() {

    $user_id = get_current_user_id();
    if ( ! $user_id ) {
      return;
    }

    $points = (int) get_user_meta( $user_id, "_wcls_points", true );

    echo( "<p><strong>Loyalty Points : </strong>" . esc_html( $points ) . "</p>" );

  }

}