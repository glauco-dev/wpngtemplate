<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

require_once("inc/helpers/request-helper.php");
require_once("inc/api/custom-endpoints.php");

require_once("inc/helpers/theme-helper.php");

require_once("options.php");

add_theme_support("menus");

add_action("init", "register_theme_menus");
add_action("widgets_init", "register_widget_areas");
add_action("customize_register", "configure_customizer");
add_action("customize_controls_enqueue_scripts", "register_customizer_js");

function register_theme_menus() {
    register_nav_menus(array(
    "header-menu" => __("Header"),"footer-menu" => __("Footer"),"sidebar-menu" => __("Sidebar Menu")
));

    ThemeHelper::create_menu_if_not_existing("Header Menu", "header-menu", array("Home","Blog","About Us","Privacy"));
ThemeHelper::create_menu_if_not_existing("Footer Menu", "footer-menu", array("Footer Item 1","Footer Item 2","Footer Item 3","Footer Item 4"));
}

function register_widget_areas() {
    register_sidebar(
    array(
        "id"            => "header-widgets",
        "name"          => __( "Header Widgets" ),
        "description"   => __( "Widgets that will appear in the header of the page" ),
        "before_widget" => "",
        "after_widget"  => "",
        "before_title"  => "",
        "after_title"   => ""
    )
);
register_sidebar(
    array(
        "id"            => "sidebar-widgets",
        "name"          => __( "Sidebar Widgets" ),
        "description"   => __( "Widgets that will appear in the sidebar of the website" ),
        "before_widget" => "",
        "after_widget"  => "",
        "before_title"  => "",
        "after_title"   => ""
    )
);
}

function configure_customizer($wp_customize) {
    ThemeHelper::add_section($wp_customize, "main", "Main Config", "Main configuration parameters");
    
    ThemeHelper::add_setting_text($wp_customize, "title", "main", "Title", "The title of this blog", null);
ThemeHelper::add_setting_text($wp_customize, "author", "main", "Author", "The author of this blog", null);
ThemeHelper::add_setting_img($wp_customize, "logo", "main", "Logo", "The website logo");
}

function register_customizer_js() {
    wp_enqueue_script(
        "custom-customize",
        get_template_directory_uri()."/js/customizer.js",
        array("jquery", "customize-controls"),
        false,
        true
    );
}