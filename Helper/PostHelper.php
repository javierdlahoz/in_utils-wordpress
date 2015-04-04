<?php

namespace INUtils\Helper;

class PostHelper{

	const PLUGIN_DIR_CSS = "/wp-content/plugins/sf-resources-manager/views/css/";
	const PLUGIN_DIR_JS = "/wp-content/plugins/sf-resources-manager/views/js/";

	/**
	 *
	 * @param string $pageTitle
	 * @param string $content
	 * @param string $url
	 * @return Ambigous <number, WP_Error>|number
	 */
	public function createPage($pageTitle, $content, $url = null, $parent = 0)
	{
		$check = get_page_by_title($pageTitle);
		if(!isset($check->ID)){
			if($url == null){
				$url = $pageTitle;
			}

			$page = array(
					'post_type' => 'page',
					'post_title' => $pageTitle,
					'post_content' => $content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_slug' => $url,
					'post_parent' => $parent
			);

			$pageId = wp_insert_post($page);
			return $pageId;
		}
		else{
			return 0;
		}
	}

	public static function addStylesAndScripts()
	{
		?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> <!-- man I really need this!! -->
		<script src="<?php wp_enqueue_script("jquery"); ?>"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-ui.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/typeahead.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/admin.js"></script>

		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo get_template_directory_uri(); ?>/css/date-picker.css" rel="stylesheet">
		<?php
	}

	/**
	 *
	 * @param string $postTypeName
	 * @param string $postTypeSingular
	 * @param string $postTypePlural
	 * @param array $supports
	 */
	public static function createPostType(
	    $postTypeName,
	    $postTypeSingular,
	    $postTypePlural,
	    $supports = array(
	        'title', 'editor', 'thumbnail'
	        )
	)
	{
	    register_post_type($postTypeName,
    	    array(
        	    'labels' => array(
            	    'name' => __( $postTypePlural ),
            	    'singular_name' => __( $postTypeSingular ),
            	    'add_new_item' => __('Add New '.$postTypeSingular),
            	    'add_new' => __('Add A '.$postTypeSingular),
            	    'edit_item' => __('Edit '.$postTypeSingular),
            	    'view_item' => __('View '.$postTypeSingular)
        	    ),
        	    'show_ui' => true,
        	    'capability_type' => 'post',
        	    'hierarchical' => false,
        	    'rewrite' => true,
        	    'public' => true,
        	    'has_archive' => true,
        	    'supports' => $supports
    	    )
	    );
	}
}
