<?php
	add_theme_support( 'title-tag' );
	// HTML5でマークアップさせる
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	function catch_that_image() {
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img = $matches [1] [0];

		if(empty($first_img)){
			// 記事内で画像がなかったときのためのデフォルト画像を指定
			$first_img = null;
		}
		return $first_img;
	}

	//概要（抜粋）の文字数調整
	function my_excerpt_length($length) {
		return 100;
	}
	add_filter('excerpt_length', 'my_excerpt_length');

	//概要（抜粋）の省略文字
	function my_excerpt_more($more) {
		return '. . . . <a href="'. get_permalink($post->ID) . '">続きを読む</a>';
	}
	add_filter('excerpt_more', 'my_excerpt_more');

	function ltl_get_the_excerpt($post_id){
	  global $post;
	  $post_bu = $post;
	  $post = get_post($post_id);
	  $output = get_the_excerpt();
	  $post = $post_bu;
	  return $output;
	}

	remove_action('wp_head','wp_generator');


	function remove_cssjs_ver2( $src ) {
		if ( strpos( $src, 'ver=' ) )
			$src = remove_query_arg( 'ver', $src );
		return $src;
	}
	add_filter( 'style_loader_src', 'remove_cssjs_ver2', 9999 );
	add_filter( 'script_loader_src', 'remove_cssjs_ver2', 9999 );
