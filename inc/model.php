<?php

class PadderModel {

    private $db_conn;
    private $input;

    public function __construct($a, $b) {

        $this->db_conn = $a;
        $this->input = $b;
    }

    public function get_data() {

        if ( is_user_logged_in() && current_user_can('manage_options')) {

            $results = get_pages();

        } else {
            $results = '';
        }

        return $results;

    }

    public function add_page() {

        // moved the input values into variables to have a shorter name to work with
        $title = $this->input['padder_page_title'];
        $content = $this->input['padder_page_content'];

        if (empty($_GET['padder_page_title']) || empty($_GET['padder_page_content'])) {

            return;

        } else {

            if (empty(trim($title)) || empty(trim($content))) {

                $output = 'Please fill in all the fields!';

            } else {

                $post_arr = array(
                    'post_title' => $title,
                    'post_content' => $content,
                    'post_type' => 'page',
                    'post_status' => 'publish',
                );

                wp_insert_post($post_arr);

                $output = 'The page '. '<strong>'.$title.'</strong>'.' has been added';
            }
        }

        return $output;

    }


    public function delete_page() {

        $page_id = $this->input['padder_delete_page'];


        if (empty($_GET)) {

            return;

        } else {

            if ($page_id !== false) {

                wp_delete_post($page_id);
                $output = 'The page has been deleted !';

            }
        }
        return $output;
    }

}
