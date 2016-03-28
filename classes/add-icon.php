<?php
/**
 * ADD ICON
 *
 * @package WordPress
 * @subpackage addMenuIcon
 * @since  1.0.0
 * @version 1.0.0
 * @author  Dor Zuberi <me@dorzki.co.il>
 * @link https://www.dorzki.co.il
 */
if( ! class_exists( 'addIcon' ) ) {

  class addIcon {

    /**
     * List of icons,
     * 
     * @var    array
     * @since  1.0.0
     */
    protected $icons = array();



    /**
     * Registers all the actions and filters.
     *
     * @since 1.0.0
     */
    public function __construct() {

      // Set icons
      $this->icons = array(
        'li_heart' => __( 'Heart', 'dorzki-add-menu-icon' ),
        'li_cloud' => __( 'Cloud', 'dorzki-add-menu-icon' ),
        'li_star'  => __( 'Star', 'dorzki-add-menu-icon' ),
        'li_tv' => __( 'TV', 'dorzki-add-menu-icon' ),
        'li_sound' => __( 'Sound', 'dorzki-add-menu-icon' ),
        'li_video' => __( 'Video', 'dorzki-add-menu-icon' ),
        'li_trash' => __( 'Trash', 'dorzki-add-menu-icon' ),
        'li_user' => __( 'User', 'dorzki-add-menu-icon' ),
        'li_key' => __( 'Key', 'dorzki-add-menu-icon' ),
        'li_search' => __( 'Search', 'dorzki-add-menu-icon' ),
        'li_settings' => __( 'Cog', 'dorzki-add-menu-icon' ),
        'li_camera' => __( 'Camera', 'dorzki-add-menu-icon' ),
        'li_tag' => __( 'Tag', 'dorzki-add-menu-icon' ),
        'li_lock' => __( 'Lock', 'dorzki-add-menu-icon' ),
        'li_bulb' => __( 'Lightbulb', 'dorzki-add-menu-icon' ),
        'li_pen' => __( 'Pen', 'dorzki-add-menu-icon' ),
        'li_diamond' => __( 'Diamond', 'dorzki-add-menu-icon' ),
        'li_display' => __( 'Display', 'dorzki-add-menu-icon' ),
        'li_location' => __( 'Location', 'dorzki-add-menu-icon' ),
        'li_eye' => __( 'Eye', 'dorzki-add-menu-icon' ),
        'li_bubble' => __( 'Bubble', 'dorzki-add-menu-icon' ),
        'li_stack' => __( 'Chat', 'dorzki-add-menu-icon' ),
        'li_cup' => __( 'Cup', 'dorzki-add-menu-icon' ),
        'li_phone' => __( 'Phone', 'dorzki-add-menu-icon' ),
        'li_news' => __( 'News', 'dorzki-add-menu-icon' ),
        'li_mail' => __( 'Mail', 'dorzki-add-menu-icon' ),
        'li_like' => __( 'Like', 'dorzki-add-menu-icon' ),
        'li_photo' => __( 'Photo', 'dorzki-add-menu-icon' ),
        'li_note' => __( 'Note', 'dorzki-add-menu-icon' ),
        'li_clock' => __( 'Clock', 'dorzki-add-menu-icon' ),
        'li_paperplane' => __( 'Paperplane', 'dorzki-add-menu-icon' ),
        'li_params' => __( 'Params', 'dorzki-add-menu-icon' ),
        'li_banknote' => __( 'Banknote', 'dorzki-add-menu-icon' ),
        'li_data' => __( 'Data', 'dorzki-add-menu-icon' ),
        'li_music' => __( 'Music', 'dorzki-add-menu-icon' ),
        'li_megaphone' => __( 'Megaphone', 'dorzki-add-menu-icon' ),
        'li_study' => __( 'Study', 'dorzki-add-menu-icon' ),
        'li_lab' => __( 'Lab', 'dorzki-add-menu-icon' ),
        'li_food' => __( 'Food', 'dorzki-add-menu-icon' ),
        'li_t-shirt' => __( 'T-Shirt', 'dorzki-add-menu-icon' ),
        'li_fire' => __( 'Fire', 'dorzki-add-menu-icon' ),
        'li_clip' => __( 'Clip', 'dorzki-add-menu-icon' ),
        'li_shop' => __( 'Shop', 'dorzki-add-menu-icon' ),
        'li_calendar' => __( 'Calendar', 'dorzki-add-menu-icon' ),
        'li_vallet' => __( 'Wallet', 'dorzki-add-menu-icon' ),
        'li_vynil' => __( 'Vynil', 'dorzki-add-menu-icon' ),
        'li_truck' => __( 'Truck', 'dorzki-add-menu-icon' ),
        'li_world' => __( 'World', 'dorzki-add-menu-icon' )
        );

      // Actions
      add_action( 'wp_setup_nav_menu_item', array( &$this, 'retrieve_menu_icon_field' ) );
      add_action( 'wp_update_nav_menu_item', array( &$this, 'save_menu_icon_field' ), 10, 3 );
      add_action( 'wp_edit_nav_menu_walker', array( &$this, 'register_menu_edit_walker' ), 10, 2 );
      add_action( 'wp_nav_menu_args', array( &$this, 'register_menu_display_walker' ), 10, 2 );
      add_action( 'wp_enqueue_scripts', array( &$this, 'register_plugin_assets' ) );
      add_action( 'plugins_loaded', array( &$this, 'register_plugin_i18n' ) );


      // Filters
      add_filter( 'menu_edit_add_fields', array( &$this, 'add_menu_icon_field' ), 10, 5 );

    }



    /**
     * Retrieves the menu icon field from the database.
     * 
     * @param  object  $menu_item  the menu item object.
     * @return object              the menu item object.
     * @since  1.0.0
     */
    public function retrieve_menu_icon_field( $menu_item ) {

      $menu_icon = get_post_meta( $menu_item->ID, '_menu_link_icon', true );

      $menu_item->link_icon = ( ! empty( $menu_icon ) ) ? $menu_icon : ''; // Possible to replace with default value.

      return $menu_item;

    }



    /**
     * Saves the menu icon field to database.
     * 
     * @param  integer  $menu_id         the menu id number.
     * @param  integer  $menu_item_id    the menu item id number.
     * @param  array    $menu_item_data  the menu item data.
     * @since  1.0.0
     */
    public function save_menu_icon_field( $menu_id, $menu_item_id, $menu_item_data ) {

      if( is_array( $_REQUEST['menu-item-icon'] ) ) {

        $link_icon = $_REQUEST['menu-item-icon'][ $menu_item_id ];

        update_post_meta( $menu_item_id, '_menu_link_icon', $link_icon );

      }

    }



    /**
     * Registers the menu edit screen walker.
     * 
     * @param  string   $walker   the assigned menu walker to use (default to Walker_Nav_Menu_Edit).
     * @param  integer  $menu_id  the menu id number.
     * @return string             the new menu edit screen walker.
     * @since  1.0.0
     */
    public function register_menu_edit_walker( $walker, $menu_id ) {

      return 'editMenuAddIconWalker';

    }



    /**
     * Registers the menu display (front-end) walker.
     * 
     * @param   array  $args  the menu args.
     * @return  array         the menu args.
     * @since  1.0.0
     */
    public function register_menu_display_walker( $args ) {

      if( empty( $args['walker'] ) ) {
        $args['walker'] = new displayMenuAddIconWalker;
      }

      return $args;

    }



    /**
     * Add the AI_PLUGIN assets so we can display the icons.
     *
     * @since  1.0.0
     */
    public function register_plugin_assets() {

      wp_enqueue_style( 'linecons-webfont', AI_PLUGIN_ROOT_URL . 'assets/css/style.css', false, false );

    }



    public function register_plugin_i18n() {

      load_plugin_textdomain( 'dorzki-add-menu-icon', false, dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/' );
      
    }



    /**
     * Add the field to the menu edit screen,
     * 
     * @param  string   $new_fields   template of new fields.
     * @param  string   $item_output  the menu item HTML output.
     * @param  object   $item         the menu item data.
     * @param  integer  $depth        the menu item depth.
     * @param  array    $args         the menu configuration args.
     * @since  1.0.0
     */
    public function add_menu_icon_field( $new_fields, $item_output, $item, $depth, $args ) {

      // Get the current icon.
      $currentValue = get_post_meta( $item->ID, '_menu_link_icon', true );

      // The field schema
      $new_fields .= '<p class="additional-menu-field-icon description description-thin">';
      $new_fields .= '  <label for="edit-menu-item-icon-' . $item->ID . '">' . __( 'Icon', 'dorzki-add-menu-icon' ) . '<br>';
      $new_fields .= '    <select id="edit-menu-item-icon-' . $item->ID . '" class="widefat code edit-menu-item-icon" name="menu-item-icon[' . $item->ID . ']">';

      foreach( $this->icons as $class => $name ) {

        $new_fields .= '      <option value="' . $class . '" ' . selected( $currentValue, $class, false ) . '>' . $name . '</option>';

      }

      $new_fields .= '    </select>';
      $new_fields .= '  </label>';
      $new_fields .= '</p>';

      return $new_fields;

    }

  }

}