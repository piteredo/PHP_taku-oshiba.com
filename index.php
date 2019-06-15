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

$updates = array();

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
$youtube_update_date = $youtube_data[0]['updatedate'];
$design_update_date = $design_all_data[0]['updatedate'];
$blog_update_date = $updates[0]['date'];
?>

<main>
  <div>
    <h2>TAKU OSHIBA</h2>
    <p><?=SYNC_ICON?><time><?=$youtube_update_date?></time></p>
  </div>

  <section>
    <p>大柴拓の公式ウェブサイトです。ギタリスト・作曲家・グラフィックデザイン・Webデザイン/プログラミング 等。ご依頼は メール にて。</p>
  </section>

  <div>
    <div>
      <h2>MOVIE</h2>
      <p><?=SYNC_ICON?><time><?=$youtube_update_date?></time></p>
    </div>
    <section>
      <ul>
      <?php $i=0; foreach($youtube_data as $row): if($i<3): ?>
        <li>
          <iframe
            src = "https://www.youtube.com/embed/<?=$row['src']?>?rel=0"
            width = "560"
            height = "315"
            frameborder = "0"
            allow = "autoplay; encrypted-media"
            allowfullscreen>
          </iframe>
        </li>
        <?php endif; $i++; endforeach; ?>
        <li>
          <p><a href="<?=$root.MOVIE_PAGE_PATH?>"><?=VIEW_ALL?></a></p>
        </li>
      </ul>
    </section>
  </div>

  <div>
    <div>
      <h2><?=DESIGN_EN?></h2>
      <p><?=SYNC_ICON?><time><?=$design_update_date?></time></p>
    </div>
    <section>
      <ul>
        <?php $i=0; foreach($design_all_data as $row): if($i<3): $url = $root.'img/design/'.$row['src'].'.jpg'; ?>
        <li>
          <a href="<?=$url?>"><img src="<?=$url?>" alt="<?=$row['src']?>"></a>
        </li>
        <?php endif; $i++; endforeach ?>
        <li>
          <p><a href="<?=$root.DESIGN_PAGE_PATH?>"><?=VIEW_ALL?></a></p>
        </li>
      </ul>
    </section>
  </div>

  <div>
    <div>
      <h2><?=BLOG_EN?></h2>
      <p><?=SYNC_ICON?><time><?=$blog_update_date?></time></p>
    </div>
    <section>
      <ul>
        <?php foreach($updates as $key): ?>
        <li>
          <section>
            <h3><a href="<?=$key['page_url']?>"><?=$key['title']?></a></h3>
            <p><?=SYNC_ICON?><time><?=$key['date']?></time></p>
            <p><?=$key['text']?><?=EXCERPT_DOTS?><a href="<?=$key['page_url']?>"><?=VIEW_ALL?></a></p>
            <p><a href="<?=$key['page_url']?>"><img src="<?=$key['img_url']?>" alt="<?=$key['img_url']?>"></a></p>
          </section>
        </li>
        <?php endforeach ?>
        <li>
          <p><a href="<?=$root.DESIGN_PAGE_PATH?>"><?=VIEW_ALL?></a></p>
        </li>
      </ul>
    </section>
  </div>
</main>

<?php require($root.'footer.php'); ?>
