<?php
$root = './';
$_GET['robot'] = 'index';
$_GET['page_name'] = 'index';
require($root.'header.php');
require($root.'blog/wp-load.php');

$pdo = initPDO();
$biography_data = getPDOStatement($pdo, BIOGRAPHY_SQL)->fetch(); //only 1 column
$biography_photo_src = getPDOStatement($pdo, PHOTO_SQL)->fetchAll()[0]['src'];
$schedule_data = getPDOStatement($pdo, SCHEDULE_SQL)->fetchAll();
$design_data = getPDOStatement($pdo, DESIGN_SQL)->fetchAll();
$discography_data = getPDOStatement($pdo, DISCOGRAPHY_SQL)->fetchAll();
$youtube_data = getPDOStatement($pdo, YOUTUBE_SQL)->fetchAll();

$updates = array(
  //BIO
  createUpdatedArticle( //page, date, title, text, image, url
    BIOGRAPHY_EN,
    $biography_data['updatedate'],
    UPDATES_BIOGRAPHY_TITLE,
    $biography_data['janame'].'&nbsp;'.$biography_data['jatext'],
    $root.'img/bio/'.$biography_photo_src.'.jpg',
    $root.BIOGRAPHY_PAGE_PATH
  ),
  //SCHEDULE
  createUpdatedArticle(
    SCHEDULE_EN,
    $schedule_data[count($schedule_data)-1]['updatedate'],
    UPDATES_SCHEDULE_TITLE,
    UPDATES_SCHEDULE_TEXT.$schedule_data[0]['date'].' '.$schedule_data[0]['title'],
    $root.'img/design/'.$schedule_data[0]['imgurl'],
    $root.SCHEDULE_PAGE_PATH
  ),
  //DESIGN
  createUpdatedArticle(
    DESIGN_EN,
    $design_data[0]['updatedate'],
    UPDATES_DESIGN_TITLE,
    UPDATES_DESIGN_TEXT,
    $root.'img/design/'.$design_data[0]['src'].'.jpg',
    $root.DESIGN_PAGE_PATH
  ),
  //DISCO
  createUpdatedArticle(
    DISCOGRAPHY_EN,
    $discography_data[0]['updatedate'],
    UPDATES_DISCOGRAPHY_TITLE,
    $discography_data[0]['title'],
    $root.'img/design/'.$discography_data[0]['imgurl'].'.jpg',
    $root.DISCOGRAPHY_PAGE_PATH
  )
);

 //BLOG * 5 articles
foreach(get_posts(array('order'=>'DESC', 'posts_per_page'=>5)) as $post) {
  $updates[] = createUpdatedArticle(
    BLOG_EN,
    substr($post->post_date, 0, 10),
    $post->post_title,
    wp_strip_all_tags($post->post_content),
    catch_that_image() != null ? catch_that_image() : $root.NO_IMG_PATH,
    $root.'blog/?p='.$post->ID
  );
}

$updates = dateSort($updates);
?>

<main id="main">
  <article>
    <?php foreach($youtube_data as $row): ?>
    <section>
      <iframe
        src = "https://www.youtube.com/embed/<?=$row['src']?>?rel=0"
        width = "560"
        height = "315"
        frameborder = "0"
        allow = "autoplay; encrypted-media"
        allowfullscreen>
      </iframe>
    </section>
  <?php endforeach ?>
  </article>

  <article>
    <div>
      <h2><?=DESIGN_EN?></h2>
      <p><?=SYNC_ICON?><time><?=$design_data[0]['updatedate']?></time></p>
    </div>
    <ul class="slider">
      <?php foreach($design_data as $row):
        $url = $root.'img/design/'.$row['src'].'.jpg'; ?>
      <li><a href="<?=$url?>"><img data-lazy="<?=$url?>" alt="<?=$row['src']?>"></a></li>
    <?php endforeach ?>
    </ul>
    <p><a href="<?=$root.DESIGN_PAGE_PATH?>"><?=VIEW_ALL?></a></p>
  </article>

  <div>
    <div>
      <h2><?=UPDATES_EN?></h2>
      <p><?=SYNC_ICON?><time><?=$updates[0]['date']?></time></p>
    </div>
    <ul>
      <?php foreach($updates as $key): ?>
      <li>
        <article>
          <div>
            <h3><a href="<?=$key['page_url']?>"><?=$key['title']?></a></h3>
            <p><?=$key['page']?>&nbsp;<?=SYNC_ICON?><time><?=$key['date']?></time></p>
          </div>
          <p><?=$key['text']?></p>
          <p><?=EXCERPT_DOTS?><a href="<?=$key['page_url']?>"><?=VIEW_ALL?></a></p>
          <p><a href="<?=$key['page_url']?>"><img src="<?=$key['img_url']?>" src="<?=$root.DUMMY_LOADER_IMG_PATH?>" alt="<?=$key['img_url']?>"></a></p>
        </article>
      </li>
    <?php endforeach ?>
    </ul>
  </div>
</main>

<?php require($root.'footer.php'); ?>
