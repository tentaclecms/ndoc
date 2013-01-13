<?php
event::register('shortcode', 'ndoc::shortcode', 2);

class ndoc {

    static function shortcode($text='') {
        add_shortcode( 'docs', 'ndoc' );

        if (function_exists('do_shortcode'))
            return do_shortcode( $text );
    }
}


function ndoc ($file) {
    $base_path = THEMES_DIR.ACTIVE_THEME.'/docs/files/';
    require_once('markdown.php');

    if (is_dir($base_path)) {

        $uri_parts = explode('/', URI);

        $uri_count = count($uri_parts);

        $uri_file = end($uri_parts);

        if ($uri_count < 2) {
            $path = $base_path.$file[0];
        } else {
            $path = $base_path.$uri_file;
        }

        if (!file_exists($path))
            return "Invalid file: ".$path;
        $use_md = false;

        if ( $use_md ) {
            $markdown = file_get_contents($path);

            $markdown_html = Markdown($markdown);

            return $markdown_html;
        } else {
            return file_get_contents($path);
        }
    } else {
        return "<p>Looks like you don't have a documents folder set up in your theme yet.</p> <p>Create a folder in your theme called <strong>/docs/files/<strong></p>";
    }
}