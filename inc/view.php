<?php

class PadderView {

    public static function generate_view($list_of_pages, $new_page_result, $delete_page_result) {

        if (empty($list_of_pages)) {

            $output = '';

        } else {
            $output = '<form>';
            $output .= 'Page Title: <input type="text" name="padder_page_title"><br><br>';
            $output .= 'Page Content: <input type="text" name="padder_page_content"><br>';
            $output .= '<input type="submit" value="Add Page">';
            $output .= '</form>';
            $output .= '<hr>';
            $output .= '<ul style="list-style-type: none">';

            foreach ($list_of_pages as $page_obj) {

                $id = $page_obj->ID;
                $title = $page_obj->post_title;
                $content = $page_obj->post_content;
                $permalink = get_permalink($page_obj);
                $delete_link = '<a href="?padder_delete_page='.$id.'">Delete Page</a>';

                $output .= '<li>';
                $output .= '<a href="'.$permalink.'">'.$title.'</a>'.' - '.$delete_link;
                $output .= '</li>';
            }

        }

        $output .= '</ul>';

        require_once(ABSPATH.'wp-admin/includes/misc.php');
        show_message($new_page_result);
        show_message($delete_page_result);


        return $output;


    }

}
