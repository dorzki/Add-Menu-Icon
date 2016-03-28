<?php
/**
 * EDIT MENU ADD ICON WALKER
 *
 * @package WordPress
 * @subpackage addMenuIcon
 * @since  1.0.0
 * @version 1.0.0
 * @author  Dor Zuberi <me@dorzki.co.il>
 * @link https://www.dorzki.co.il
 */
if( ! class_exists( 'editMenuAddIconWalker' ) ) {

  class editMenuAddIconWalker extends Walker_Nav_Menu_Edit {

    /**
     * Output the item form.
     * 
     * @param  string   &$output  the item form.
     * @param  object   $item     the item data.
     * @param  integer  $depth    the item depth.
     * @param  array    $args     the menu args.
     * @since  1.0.0
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

      $item_output = '';

      parent::start_el( $item_output, $item, $depth, $args );

      $new_fields = apply_filters( 'menu_edit_add_fields', '', $item_output, $item, $depth, $args );

      // Inject $new_fields before: <div class="menu-item-actions description-wide submitbox">
      if( ! empty( $new_fields ) ) {
        $item_output = preg_replace( '/(?=<div[^>]+class="[^"]*submitbox)/', $new_fields, $item_output );
      }

      $output .= $item_output;

    }

  }

}