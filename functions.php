<?php
    
    function garden_theme_support() {
            add_theme_support('title-tag');
            add_theme_support('custom-logo');
            add_theme_support('post-thumbnails');
    }

    add_action('after_setup_theme', 'garden_theme_support');

    function garden_menus() {
        $locations = array(
            'primary' => 'Desktop Primary Menu',
            'footer'=> "Footer Menu"
        );
        register_nav_menus($locations);
    }

    add_action('init', 'garden_menus');

    function garden_register_styles() {
       $version = wp_get_theme()->get('version');
        wp_enqueue_style('garden-style', get_template_directory_uri() . "/style.css", array('garden-bootstrap'), $version, 'all');
        wp_enqueue_style('garden-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css", array(), '5.3.3', 'all');
    }

    add_action('wp_enqueue_scripts', 'garden_register_styles');

    function garden_register_scripts() {
        wp_enqueue_script('garden-jquery', "https://code.jquery.com/jquery-3.7.1.slim.min.js", array(), '3.7.1', true);
        wp_enqueue_script('garden-popper', "https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js", array(), '2.9.2', true);
        wp_enqueue_script('garden-bootstrap', "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js", array(), '5.3.3', true);
      
        wp_enqueue_script('garden-fontawesome', "https://kit.fontawesome.com/3e1b7e2b95.js", array(), '5', true);
        wp_enqueue_script('garden-js', get_template_directory_uri() . "/assets/js/main.js", array(), '1.0', true);
     }
 
     add_action('wp_enqueue_scripts', 'garden_register_scripts');


     function garden_widget_areas() {
        register_sidebar (
            array(
                'before_title' => '<h2>',
                'after_title' => '</h2>',
                'before_widget' => '',
                'after_widget' => '',
                'name' => 'Sidebar Area',
                'id' => 'sidebar-1',
                'description' => 'Sidebar Widget Area'
            )
            );
            register_sidebar (
                array(
                    'before_title' => '<h2>',
                    'after_title' => '</h2>',
                    'before_widget' => '',
                    'after_widget' => '',
                    'name' => 'Footer Area',
                    'id' => 'footer-1',
                    'description' => 'Footer Widget Area'
                )
                );
     }

     add_action( 'widgets_init', 'garden_widget_areas');

    //  function add_class_to_menu_items($classes, $item, $args, $depth) {
    //     // Sprawdzamy, czy to menu o nazwie "primary"
    //     if (isset($args->theme_location) && $args->theme_location === 'primary') {
    //         $classes[] = 'dropdown'; // Dodaj klasę do każdej pozycji
    //     }
    //     return $classes;
    // }

    // add_filter('nav_menu_css_class', 'add_class_to_menu_items', 10, 4);

    function customize_nav_menu_link_attributes($atts, $item, $args) {
        // Jeśli element ma submenu
        if (in_array('menu-item-has-children', $item->classes)) {
            $atts['class'] = 'btn btn-secondary dropdown-toggle';
            $atts['id'] = 'dropdownMenuLink';
            // $atts['data-toggle'] = 'dropdown'; // Dla Bootstrap 4
            $atts['data-bs-toggle'] = 'dropdown'; // Dla Bootstrap 5
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
            $atts['role'] = 'button';
        }
        return $atts;
    }
    add_filter('nav_menu_link_attributes', 'customize_nav_menu_link_attributes', 10, 3);
    
    
    function customize_submenu_classes($classes, $args, $depth) {
        // Sprawdzenie, czy jesteśmy w submenu
        if ($depth >= 0) {
            $classes = ['dropdown-menu']; // Nadpisuje klasy submenu na klasę Bootstrap 5
        }
        return $classes;
    }
    add_filter('nav_menu_submenu_css_class', 'customize_submenu_classes', 10, 3);
    

    function customize_nav_menu_li_classes($classes, $item, $args, $depth) {
        if ($depth > 0) {
            $classes[] = 'dropdown-item'; // Dodaje klasę do pozycji w submenu
        }
        return $classes;
    }
    add_filter('nav_menu_css_class', 'customize_nav_menu_li_classes', 10, 4);
    
    
