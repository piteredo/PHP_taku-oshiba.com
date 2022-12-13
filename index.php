<?php
$root = './';
$page_name = 'index';
$_GET['robot'] = 'index';
$_GET['page_name'] = $page_name;
require($root.'header.php');
require('blog/wp-load.php');

//UPDATES
$biography_updates = [];
$schedule_updates = [];
$video_updates = [];
$design_updates = [];
$discography_updates = [];
$blog_updates = [];

//BIO
$bio_data = getPDOStatement($pdo, BIOGRAPHY_SQL)->fetch(); //only 1 column
$photos = getPDOStatement($pdo, PHOTO_SQL)->fetchAll();
$type = 'biography';
$url = 'biography';
$date = "2021-02-20";//getUpdateDate($pdo, 'biography');
$fullpath = $root.'img/bio/'.$photos[0]['src'].'.jpg';
$title = "[BIO] " . $bio_data['janame'] . " (" . $bio_data['janame_ruby'] . ") / " . $bio_data['enname'];
$text = $bio_data['jatext_short'];
$biography_updates[] = array('type'=>$type, 'url'=>$url, 'date'=>$date, 'fullpath'=>$fullpath, 'title'=>$title, 'text'=>$text);

//SCHEDULE
$schedule_data = getPDOStatement($pdo, SCHEDULE_SQL)->fetchAll();
$schedule_data = scheduleDateSortAsc($schedule_data, "date");
$type = 'schedule';
$url = 'schedule';
$date = getUpdateDate($pdo, 'schedule');
if($schedule_data[0]['imgurl'] != null) $fullpath = $root. 'img/design/'. $schedule_data[0]['imgurl'];
else $fullpath = $root. 'img/no-image.png';
$title = "[SCHEDULE] 次回出演: " . $schedule_data[0]['date'] . ' ' . $schedule_data[0]['title'];
$text = "###";
$schedule_updates[] = array('type'=>$type, 'url'=>$url, 'date'=>$date, 'fullpath'=>$fullpath, 'title'=>$title, 'text'=>$text);

//VIDEO
/*$maxResults = 3;
$address = $apiAddress . $checkId . $fragment . "&key=" . $yt_apiKey . "&maxResults=" . $maxResults;
$json = cuGet_contents( $address );
$json_decode = json_decode($json, true);
foreach ($json_decode['items'] as $video) {
  $type = 'video';
  $url = 'video';
  $date = substr($video['snippet']['publishedAt'], 0, 10);
  $fullpath = 'https://www.youtube.com/embed/' . $video['snippet']['resourceId']['videoId'] . '?rel=0';
  $title = "[VIDEO] " . $video['snippet']['title'];
  $text = mb_substr($video['snippet']['description'], 0, 160) . " ...";
  $video_updates[] = array('type'=>$type, 'url'=>$url, 'date'=>$date, 'fullpath'=>$fullpath, 'title'=>$title, 'text'=>$text);
}*/

//VIDEO_new(200803)
$video_data = getPDOStatement($pdo, YOUTUBE_SQL)->fetchAll();
$date = $video_data[0]['updatedate'];
foreach ($video_data as $video) {
  $fullpath = 'https://www.youtube.com/embed/' . $video['src'] . '?rel=0';
  $video_updates[] = array('date'=>$date, 'fullpath'=>$fullpath);
}

//DESIGN
$num   = 8;
$query = 'media.limit('. $num. '){caption,media_url,permalink,timestamp,thumbnail_url}';
$json  = file_get_contents("{$f_api}{$ig_id}?fields={$query}&access_token={$token}");
$data  = json_decode($json, true);
$medias = $data['media']['data'];
foreach ($medias as $media) {
  $type = 'design';
  $url = 'design';
  $date = substr($media['timestamp'], 0, 10);
  $fullpath = $media['media_url'];
  $thumbnail = $media['thumbnail_url'];
  $title = "[DESIGN] " . deleteHashTags($media['caption']);
  $text = deleteHashTags($media['caption']);
  $design_updates[] = array('type'=>$type, 'url'=>$url, 'date'=>$date, 'fullpath'=>$fullpath, 'thumbnail'=>$thumbnail, 'title'=>$title, 'text'=>$text);
}

//DISCO
$discography_data = getPDOStatement($pdo, DISCOGRAPHY_SQL)->fetchAll();
$performer_id_list = strListToArray($discography_data[0]['performeridlist']);
$player_prepare = getPDOPreparedStatement($pdo, PLAYER_SQL);
$text = "";
foreach($performer_id_list as $performer_id){
  $player = getPlayerById($player_prepare, $performer_id);
  $player_name = $player['name'];
  $player_instrument = $player['instrument'];
  $text .= $player_name . " (" . $player_instrument . ")　";
}
$type = 'discography';
$url = 'discography';
$date = getUpdateDate($pdo, 'discography');
$fullpath = $root. 'img/design/'. $discography_data[0]['imgurl']. '.jpg';
$title = "[DISCO] " . $discography_data[0]['title'];
$discography_updates[] = array('type'=>$type, 'url'=>$url, 'date'=>$date, 'fullpath'=>$fullpath, 'title'=>$title, 'text'=>$text);

//BLOG * 5
$arg = array(
  'post_status' => 'publish',
  'order' => 'DESC',
  'posts_per_page' => 1,
);
foreach (get_posts($arg) as $post) {
  if(catch_that_image() != "#"){
    $image = catch_that_image();
  }
  else {
    $image = 'https://taku-oshiba.com/img/no-image.png';
  }
  $blog_updates[] = [
    'type' => 'blog',
    'url' => './blog/?p=' . $post->ID,
    'date' => substr($post->post_date, 0, 10),
    'title' => $post->post_title,
    'text' => mb_substr(wp_strip_all_tags($post->post_content), 0, 100) . " ...",
    'fullpath' => $image
  ];
}


//$updates = dateSort($updates);
//$total_update_date = $updates[0]['date'];

//echo json_encode($updates);
?>

<main class="main">
  <section class="content">
    <h2 class="content__header-title"><?=SITE_LOGO?></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time><?=$biography_updates[0]['date']?></time></p>
    <ul>
    <?php
    foreach($biography_updates as $content): ?>
      <li class="content__section section">
        <!--<p class="section__update-date">
          <?=SYNC_ICON?><time><?=$content['date']?></time>
        </p>
        <h3 class="section__title-text section__title-text--narrow-bottom">
          <?=$content['title']?>
        </h3>-->
        <p class="section__sentence">
          <?=$content['text']?></br>
        </p>
        <p class="section__label section__label--view-all">
          <a href="./biography"><?=VIEW_ALL_BIOGRAPHY?> ≫</a>
        </p>
        <p class="section__square-image-wrapper section__schedule-image">
          <a href="./<?=$content['url']?>">
            <img src="<?=$content['fullpath']?>" class="section__square-image" alt="<?=$content['text']?>">
          </a>
        </p>
      </li>
    <?php endforeach; ?>
    </ul>
  </section>

  <section class="content">
    <h2 class="content__header-title"><?=VIDEO_EN?></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time><?=$video_updates[0]['date']?></time></p>
    <ul>
    <?php foreach($video_updates as $content): ?>
      <li class="video-list">
        <iframe
          src = <?=$content['fullpath']?>
          class="video-list__video video-list__video--square"
          width = "560"
          height = "315"
          frameborder = "0"
          allow = "autoplay; encrypted-media"
          allowfullscreen>
        </iframe>
      </li>
    <?php endforeach; ?>
    </ul>
    <p class="section__label section__label--view-all">
      <a href="<?=YOUTUBE_URL?>" target="_blank"><?=VIEW_ALL_VIDEO?></a>
    </p>
  </section>

  <section class="content">
    <h2 class="content__header-title"><?=DESIGN_EN?></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time>2022-12-12</time></p>
    <ul class="image-list">

    <?php
      $dirpath = "./img/design/";
      $dir = opendir($dirpath);
      $file_list = array();
      $time_list = array();
      $num = 6;
      while( false !== ($file = readdir($dir))) {
        if($file[0] != "."){
          $time_list[] = filemtime($dirpath.$file);
          $file_list[] = $file;
        }
      }
      closedir($dir);
      array_multisort($time_list, SORT_DESC, $file_list);

      foreach($file_list as $filename):
        $ext = substr($filename, strrpos($filename, '.') +1);
          if( $num> 0 && $ext == "jpg" ): ?>
            <li class="image-list__image-li">
              <a href="../img/design/<?=$filename?>">
                <img src="../img/design/<?=$filename?>" class="image-list__image">
              </a>
            </li>
          <?php
          $num--;
          endif;
      endforeach;?>
    </ul>
    <p class="section__label section__label--view-all">
      <a href="<?=INSTAGRAM_URL?>" target="_blank"><?=VIEW_ALL_DESIGN?></a>
    </p>
  </section>

  <section class="content">
    <h2 class="content__header-title"><?=BLOG_EN?></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time><?=$blog_updates[0]['date']?></time></p>
    <ul>
    <?php
    foreach($blog_updates as $content): ?>
      <li class="content__section section">
        <p class="section__label">
          <time><?=$content['date']?></time> <?=getDay($content['date'])?>
        </p>
        <h3 class="section__title-text">
          <?=$content['title']?>
        </h3>
        <p class="section__sentence">
          <?=$content['text']?> <a href="./<?=$content['url']?>"><?=VIEW_ALL?> ≫</a>
        </p>
        <p class="section__square-image-wrapper section__schedule-image">
          <a href="./<?=$content['url']?>">
            <img src="<?=$content['fullpath']?>" class="section__square-image" alt="<?=$content['text']?>">
          </a>
        </p>
      </li>
    <?php endforeach; ?>
    </ul>
    <p class="section__label section__label--view-all">
      <a href="./<?=$content['type']?>"><?=VIEW_ALL_BLOG?> ≫</a>
    </p>
  </section>
</main>

<?php require($root.'footer.php'); ?>
