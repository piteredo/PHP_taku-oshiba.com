<?php
$root = './';
$_GET['robot'] = 'index';
$_GET['page_name'] = 'index';
require($root.'header.php');
require($root.'../blog/wp-load.php'); //実装時パス直す

$pdo = initPDO();
$biography_data = getPDOStatement($pdo, BIOGRAPHY_SQL)->fetch(); //only 1 column
$biography_photo_src = getPDOStatement($pdo, PHOTO_SQL)->fetchAll()[0]['src'];
$schedule_data = getPDOStatement($pdo, SCHEDULE_SQL)->fetchAll();
$player_prepare = getPDOPreparedStatement($pdo, PLAYER_SQL);
$design_all_data = getPDOStatement($pdo, DESIGN_ALL_SQL)->fetchAll();
$discography_data = getPDOStatement($pdo, DISCOGRAPHY_SQL)->fetchAll();
$youtube_data = getPDOStatement($pdo, YOUTUBE_SQL)->fetchAll();

//書き直す
$performer_id_list = getPerformerIdList($schedule_data[0]['performeridlist']);
foreach($performer_id_list as $performer_id){
  $player = getPlayerById($player_prepare, $performer_id);
  $players_schedule .= $player['name'].'('.$player['instrument'].') ';
}
$performer_id_list = getPerformerIdList($discography_data[0]['performeridlist']);
foreach($performer_id_list as $performer_id){
  $player = getPlayerById($player_prepare, $performer_id);
  $players_discography .= $player['name'].'('.$player['instrument'].') ';
}


$updates = array(
  //BIO
  /*createUpdatedArticle( //page, date, title, text, image, url
    BIOGRAPHY_EN,
    $biography_data['updatedate'],
    UPDATES_BIOGRAPHY_TITLE,
    mb_substr(strip_tags($biography_data['janame'].'&nbsp;'.$biography_data['jatext']), 0, 100),
    $root.'img/bio/'.$biography_photo_src.'.jpg',
    $root.BIOGRAPHY_PAGE_PATH
  ),
  //SCHEDULE
  createUpdatedArticle(
    SCHEDULE_EN,
    $schedule_data[count($schedule_data)-1]['updatedate'],
    UPDATES_SCHEDULE_TITLE,
    strip_tags(UPDATES_SCHEDULE_TEXT).'<br/>'.$schedule_data[0]['date'].'<br/>'.$schedule_data[0]['title'].'<br/>'.$players_schedule.'<br/>',
    $root.'img/design/'.$schedule_data[0]['imgurl'],
    $root.SCHEDULE_PAGE_PATH
  ),
  //DESIGN
  createUpdatedArticle(
    DESIGN_EN,
    $design_all_data[0]['updatedate'],
    UPDATES_DESIGN_TITLE,
    mb_substr(strip_tags(DESIGN_GREETING_TEXT), 0, 100).'<br/>',
    $root.'img/design/'.$design_all_data[0]['src'].'.jpg',
    $root.DESIGN_PAGE_PATH
  ),
  //DISCO
  createUpdatedArticle(
    DISCOGRAPHY_EN,
    $discography_data[0]['updatedate'],
    UPDATES_DISCOGRAPHY_TITLE,
    strip_tags(UPDATES_DISCOGRAPHY_TEXT).'<br/>'.$discography_data[0]['title'].'<br/>'.$players_discography.'<br/>',
    $root.'img/design/'.$discography_data[0]['imgurl'].'.jpg',
    $root.DISCOGRAPHY_PAGE_PATH
  )*/
);

 //BLOG * 5 articles
foreach(get_posts(array('order'=>'DESC', 'posts_per_page'=>5)) as $post) {
  $updates[] = createUpdatedArticle(
    BLOG_EN,
    substr($post->post_date, 0, 10),
    $post->post_title,
    mb_substr(wp_strip_all_tags($post->post_content), 0, 100),
    catch_that_image() != null ? catch_that_image() : $root.NO_IMG_PATH,
    $root.'blog/?p='.$post->ID
  );
}

$updates = dateSort($updates);
?>

<main id="main">
  <div class="header">
    <h2 class="page-title">TAKU OSHIBA</h2>
    <p class="updated-date"><?=SYNC_ICON?><time><?=$youtube_data[0]['updatedate']?></time></p>
  </div>

  <section class="article-section">
    <p class="text-section">大柴拓の公式ウェブサイトです。ギタリスト・作曲家・グラフィックデザイン・Webデザイン/プログラミング 等。ご依頼は メール にて。</p>
  </section>

  <div class="movie article-section">
    <div class="header">
      <h2 class="page-title">MOVIE</h2>
      <p class="updated-date"><?=SYNC_ICON?><time><?=$youtube_data[0]['updatedate']?></time></p>
    </div>
    <section>
      <ul class="square-trim-ul">
        <?php $i=0; foreach($youtube_data as $row): if($i<3): ?>
        <li class="square-trim-wrapper"><iframe
            src = "https://www.youtube.com/embed/<?=$row['src']?>?rel=0"
            width = "560"
            height = "315"
            frameborder = "0"
            allow = "autoplay; encrypted-media"
            allowfullscreen>
        </iframe></li>
        <?php endif; $i++; endforeach; ?>
        <li class="view-all-wrapper"><p><a href="<?=$root.MOVIE_PAGE_PATH?>"><?=VIEW_ALL?></a></p></li>
      </ul>
    </section>
  </div>

  <div class="design article-section">
    <div class="header">
      <h2 class="page-title"><?=DESIGN_EN?></h2>
      <p class="updated-date"><?=SYNC_ICON?><time><?=$design_all_data[0]['updatedate']?></time></p>
    </div>
    <section>
      <ul class="square-trim-ul">
        <?php $i=0; foreach($design_all_data as $row): if($i<3): $url = $root.'img/design/'.$row['src'].'.jpg'; ?>
        <li class="square-trim-wrapper"><a href="<?=$url?>"><img src="<?=$url?>" alt="<?=$row['src']?>"></a></li>
        <?php endif; $i++; endforeach ?>
        <li class="view-all-wrapper"><p><a href="<?=$root.DESIGN_PAGE_PATH?>"><?=VIEW_ALL?></a></p></li>
      </ul>
    </section>
  </div>

  <div class="blog">
    <div class="header">
      <h2 class="page-title"><?=BLOG_EN?></h2>
      <p class="updated-date"><?=SYNC_ICON?><time><?=$updates[0]['date']?></time></p>
    </div>
    <section>
      <ul>
        <?php foreach($updates as $key): ?>
        <li>
          <article class="article-section">
            <section class="text-section">
              <h3 class="title"><a href="<?=$key['page_url']?>"><?=$key['title']?></a></h3>
              <p class="updated-date"><?=SYNC_ICON?><time><?=$key['date']?></time></p>
              <p class="text"><?=$key['text']?><?=EXCERPT_DOTS?><a href="<?=$key['page_url']?>"><?=VIEW_ALL?></a></p>
            </section>
            <section class="image-section">
              <p><a href="<?=$key['page_url']?>"><img src="<?=$key['img_url']?>" alt="<?=$key['img_url']?>"></a></p>
            </section>
          </article>
        </li>
        <?php endforeach ?>
        <li class="view-all-wrapper"><p><a href="<?=$root.DESIGN_PAGE_PATH?>"><?=VIEW_ALL?></a></p></li>
      </ul>
    </section>
  </div>
</main>

<?php require($root.'footer.php'); ?>
