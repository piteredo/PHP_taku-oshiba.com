<?php
$root = '../././././';
$page_name = 'blog';
$_GET['robot'] = 'index';
$_GET['page_name'] = $page_name;
require('header.php');

$update_date = get_author_latest_update(1);
?>

<main class="main">
	<article class="content">
		<h2 class="content__header-title"><a href="<?=$root.BLOG_PAGE_PATH?>"><?=BLOG_EN?></a></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time><?=$update_date?></time></p>

		<?php if(have_posts()): while(have_posts()): the_post(); ?>
			<section class="content__section section">
				<p class="section__label">
					<time datetime="<?=get_the_date( 'Y-m-d' );?>"><?=the_time('Y-m-d D');?></time>
				</p>

				<h3 class="section__title-text">
					<a href="<?=the_permalink();?>"><?=the_title();?></a>
				</h3>

				<div class="section__sentence">
					<?=the_excerpt();?>
				</div>

				<p class="section__blog-image section__square-image-wrapper">
					<a href="<?=the_permalink();?>">
						<img src="<?php echo catch_that_image(); ?>" class="section__square-image" alt="<?php the_title(); ?>" />
					</a>
				</p>
			</section>
		<?php endwhile; endif; ?>

		<?php
			echo paginate_links(array(
			  'type' => 'list',
			  'mid_size' => '1',
			  'prev_text' => '&laquo;',
			  'next_text' => '&raquo;'
			));
		?>
	</article>
</main>

<?php require('footer.php'); ?>
