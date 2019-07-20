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

		<?php if(have_posts()): the_post(); ?>
			<section class="content__section section">
				<p class="section__label">
					<time datetime="<?=get_the_date( 'Y-m-d' );?>"><?=the_time('Y-m-d D');?></time>
				</p>

				<h3 class="section__title-text">
					<?php the_title(); ?>
				</h3>

				<div class="sns-share-buttons">
					<div
						class="fb-share-button"
						data-href="<?php echo get_the_permalink();?>"
						data-layout="button"
						data-size="small"
						data-mobile-iframe="true"
					>
						<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">シェア</a>
					</div>
					<a
						href="https://twitter.com/share?ref_src=twsrc%5Etfw"
						class="twitter-share-button"
						data-show-count="false"
						data-text="<?php the_title(); ?>">
						Tweet
					</a>
					<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>

				<div class="section__sentence">
					<?=the_content(); ?>
				</div>
			</section>
		<?php endif; ?>

		<ul class="singlepage_prev_next_link">
			<li><?php previous_post_link('&laquo; %link', '%title', false, 2); ?></li>
			<li><?php next_post_link('%link &raquo;', '%title', false, 2); ?></li>
		</ul>
	</article>
</main>

<?php require('footer.php'); ?>
