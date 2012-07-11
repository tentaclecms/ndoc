<?php
class Ndoc extends Modules {

    public function __init() {
        $this->addAlias("shortcode", "shortcode", 2);
		add_shortcode( 'docs', 'ndoc' );
    }


	public function shortcode($text='') {
		if (function_exists('do_shortcode'))
		    return do_shortcode( $text );
	}
}


function ndoc ($file) {
	$base_path = THEMES_DIR.ACTIVE_THEME.'/docs/files/';
	 
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
			
		return file_get_contents($path);
	} else {
		return "<p>Looks like you don't have a documents folder set up. <p>Create a folder in your theme called /docs/files/</p> ".$path;
	}
}
