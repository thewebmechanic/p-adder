<?php

/**
*   Plugin Name: P-Adder
*   Plugin URI: https://github.com/thewebmechanic/p-adder
*   Description: P-Adder is a simple WordPress plugin which allows an admin to quickly add or remove static pages, using the shortcode provided.
*   Version: 1.0
*   Author: thewebmechanic
*   Author URI: https://github.com/thewebmechanic
*   License: http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
*/

// no direct access

if (!defined('ABSPATH')) { die; }

add_shortcode('padder_add_page', 'padder_add_page');

function padder_add_page($atts) {

    require_once('inc/model.php');
    require_once('inc/view.php');

    global $wpdb;
    $input = array();

    $input['padder_page_title'] = !empty($_GET['padder_page_title']) ? $_GET['padder_page_title'] : false;
    $input['padder_page_content'] = !empty($_GET['padder_page_content']) ? $_GET['padder_page_content'] : false;
    $input['padder_delete_page'] = (!empty($_GET['padder_delete_page']) && is_numeric($_GET['padder_delete_page'])) ? $_GET['padder_delete_page'] : false;

    $model_obj = new PadderModel($wpdb, $input);

    $new_page_result = $model_obj->add_page();
    $delete_page_result = $model_obj->delete_page();
    $list_of_pages = $model_obj->get_data();


    $output = PadderView::generate_view($list_of_pages, $new_page_result, $delete_page_result);

    return $output;

}

