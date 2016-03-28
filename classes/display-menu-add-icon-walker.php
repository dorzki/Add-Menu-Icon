<?php
/**
 * DISPLAY MENU ADD ICON WALKER
 *
 * @package WordPress
 * @subpackage addMenuIcon
 * @since  1.0.0
 * @version 1.0.0
 * @author  Dor Zuberi <me@dorzki.co.il>
 * @link https://www.dorzki.co.il
 */
if( ! class_exists( 'displayMenuAddIconWalker' ) ) {

  class displayMenuAddIconWalker extends Walker_Nav_Menu {

    /**
     * Output the menu item on the front-end.
     * 
     * @param  string   &$output  the item output.
     * @param  object   $item     the item data.
     * @param  integer  $depth    the item depth.
     * @param  array    $args     the menu args.
     * @since  1.0.0
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

      global $wp_query;
      $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

      $class_names = $value = '';

      $classes = empty( $item->classes ) ? array() : (array) $item->classes;

      $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
      $class_names = ' class="'. esc_attr( $class_names ) . '"';

      $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

      $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
      $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
      $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
      $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

      $prepend = '<span>';
      $append = '</span>';
      $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

      if($depth != 0)
      {
        $description = $append = $prepend = "";
      }

      $item_output = $args->before;
      $item_output .= '<a'. $attributes .'><span aria-hidden="true" class="' . $item->link_icon . '"></span>';
      $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
      $item_output .= $description.$args->link_after;
      $item_output .= '</a>';
      $item_output .= $args->after;

      $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }

  }

}