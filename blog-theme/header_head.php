<head prefix="og: http://ogp.me/ns#">
  <?php if( is_home() ): ?>
    <title><?=SITE_TITLE?></title>
  <?php elseif( is_single() || is_page() ): ?>
    <title><?php the_title(); ?><?=SITE_TITLE_SUF?></title>
  <?php endif; ?>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <meta name="description" content="<?=SITE_DESCRIPTION?>">

  <?php if(is_tag() || is_date() || is_search() || is_404() || is_category()): ?>
		<meta name="robots" content="noindex"/>
	<?php else : ?>
		<meta name="robots" content="index"/>
	<?php endif; ?>

  <?php if( is_home() ): ?>
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php bloginfo( 'name' ); ?>">
  <?php
  $http = is_ssl() ? 'https' . '://' : 'http' . '://';
  $url = $http . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
  ?>
    <meta property="og:url" content="<?php echo $url; ?>">
    <meta property="og:description" content="<?php bloginfo( 'description' ) ?>">
    <meta property="og:image" content="<?=$root.OG_IMG_PATH?>">
  <?php elseif( is_single() || is_page() ): ?>
		<meta property="og:type" content="article">
		<meta property="og:title" content="<?php the_title(); ?>">
		<meta property="og:url" content="<?php the_permalink(); ?>">
	<?php
		$excerpt_text	= wp_html_excerpt( $post->post_content, 80, '...' );
	?>
	<meta property="og:description" content="<?php echo $excerpt_text;?>">
	<?php
    $postthumb = catch_that_image();
  ?>
		<meta property="og:image" content="<?php echo $postthumb; ?>">
	<?php endif; ?>

  <meta property="og:site_name" content="<?php bloginfo( 'name' ); ?>">
  <meta property="og:locale" content="ja_JP">
  <meta name="twitter:site" content="<?=TWITTER_CREATOR?>">
  <meta name="twitter:creator" content="<?=TWITTER_CREATOR?>">
  <meta name="twitter:card" content="summary_large_image">

  <link rel="icon" type="image/x-icon" href="<?=$root?>img/favicon.ico">
  <link rel="apple-touch-icon" sizes="180x180" href="<?=$root?>img/apple-touch-icon-180x180.png">

  <link rel="stylesheet" href="<?=$root?>css/reset.css">
  <link rel="stylesheet" href="<?=$root?>css/main.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
  <link rel="stylesheet" href="<?=$root?>css/slick.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/css/modaal.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css">

  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="<?=$root?>js/slick.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>-->
  <script src="<?=$root?>js/main.js"></script>
  <script>
    $(function() {
      $('.slider').slick({
        autoplay: false,
        arrows: true,
        slidesToShow: 2,
        centerMode: true,
        initialSlide: 1,
        prevArrow:'<div class="prev"><i class="fas fa-angle-left"></i></div>',
        nextArrow:'<div class="next"><i class="fas fa-angle-right"></i></div>'
      });

      $('.modal').modaal({
    	  type: "image"
      });

      $(function() {
   	    $('img.lazy').lazyload();
   	  });
    });

	  window.fbAsyncInit = function() {
		  FB.init({
			  appId      : '1131056777045419',
			  xfbml      : true,
			  version    : 'v2.10'
		  });
		  FB.AppEvents.logPageView();
	  };

	  (function(d, s, id){
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) {return;}
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/ja_JP/sdk.js";
		  fjs.parentNode.insertBefore(js, fjs);
	  }(document, 'script', 'facebook-jssdk'));
  </script>
 <?php wp_head(); ?>
</head>
