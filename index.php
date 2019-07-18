<?php
$root = './';
$page_name = 'index';
$_GET['robot'] = 'index';
$_GET['page_name'] = $page_name;
require($root.'header.php');

//UPDATES
$updates = [];

//BIO
$bio_data = getPDOStatement($pdo, BIOGRAPHY_SQL)->fetch(); //only 1 column
$photos = getPDOStatement($pdo, PHOTO_SQL)->fetchAll();
$type = 'biography';
$date = getUpdateDate($pdo, 'biography');
$fullpath = $root.'img/bio/'.$photos[0]['src'].'.jpg';
$title = "[BIO] " . $bio_data['janame'] . " (" . $bio_data['janame_ruby'] . ") / " . $bio_data['enname'];
$text = str_replace("<br/>", "", mb_substr($bio_data['jatext'], 0, 160)) . " ...";
$updates[] = array('type'=>$type, 'date'=>$date, 'fullpath'=>$fullpath, 'title'=>$title, 'text'=>$text);

//SCHEDULE
$schedule_data = getPDOStatement($pdo, SCHEDULE_SQL)->fetchAll();
$schedule_data = scheduleDateSortAsc($schedule_data, "date");
$type = 'schedule';
$date = getUpdateDate($pdo, 'schedule');
if($schedule_data[0]['imgurl'] != null) $fullpath = $root. 'img/design/'. $schedule_data[0]['imgurl'];
else $fullpath = $root. 'img/no-image.png';
$title = "[SCHEDULE] 次回出演: " . $schedule_data[0]['date'] . ' ' . $schedule_data[0]['title'];
$text = "###";
$updates[] = array('type'=>$type, 'date'=>$date, 'fullpath'=>$fullpath, 'title'=>$title, 'text'=>$text);

//VIDEO
$maxResults = 2;
$address = $apiAddress . $checkId . $fragment . "&key=" . $yt_apiKey . "&maxResults=" . $maxResults;
$json = cuGet_contents( $address );
$json_decode = json_decode($json, true);
foreach ($json_decode['items'] as $video) {
  $type = 'video';
  $date = substr($video['snippet']['publishedAt'], 0, 10);
  $fullpath = 'https://www.youtube.com/embed/' . $video['snippet']['resourceId']['videoId'] . '?rel=0';
  $title = "[VIDEO] " . $video['snippet']['title'];
  $text = mb_substr($video['snippet']['description'], 0, 160) . " ...";
  $updates[] = array('type'=>$type, 'date'=>$date, 'fullpath'=>$fullpath, 'title'=>$title, 'text'=>$text);
}

//DESIGN
$num   = 3;
$query = 'media.limit('. $num. '){caption,media_url,permalink,timestamp,thumbnail_url}';
$json  = file_get_contents("{$f_api}{$ig_id}?fields={$query}&access_token={$token}");
$data  = json_decode($json, true);
$medias = $data['media']['data'];
foreach ($medias as $media) {
  $type = 'design';
  $date = substr($media['timestamp'], 0, 10);
  $fullpath = $media['media_url'];
  $thumbnail = $media['thumbnail_url'];
  $title = "[DESIGN] " . deleteHashTags($media['caption']);
  $text = deleteHashTags($media['caption']);
  $updates[] = array('type'=>$type, 'date'=>$date, 'fullpath'=>$fullpath, 'thumbnail'=>$thumbnail, 'title'=>$title, 'text'=>$text);
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
$date = getUpdateDate($pdo, 'discography');
$fullpath = $root. 'img/design/'. $discography_data[0]['imgurl']. '.jpg';
$title = "[DISCO] " . $discography_data[0]['title'];

$updates[] = array('type'=>$type, 'date'=>$date, 'fullpath'=>$fullpath, 'title'=>$title, 'text'=>$text);


$updates = dateSort($updates);
$total_update_date = $updates[0]['date'];

//echo json_encode($updates);
?>

<main class="main">
  <section class="content">
    <!--<h2 class="content__header-title">
      <?=INDEX_GREETING_TITLE?>
    </h2>
    <p class="content__header-update-date">
      <?=SYNC_ICON?><time><?=$total_update_date?></time>
    </p>-->
    <p class="content__description">
      <?=INDEX_GREETING_TEXT?>
    </p>
  </section>

  <section class="content">
    <h2 class="content__header-title"><?=UPDATES_EN?></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time><?=$total_update_date?></time></p>
    <ul>
    <?php
    foreach($updates as $content):
      if($content['type'] == "video"):
      ?>
      <li class="content__section section">
        <p class="section__update-date">
          <?=SYNC_ICON?><time><?=$content['date']?></time>
        </p>
        <h3 class="section__title-text section__title-text--narrow-bottom">
          <?=$content['title']?>
        </h3>
        <p class="section__label">
          <a href="./<?=$content['type']?>">≫view <?=$content['type']?> page</a>
        </p>
        <iframe
          src = <?=$content['fullpath']?>
          frameborder = "0"
          allow = "autoplay; encrypted-media"
          allowfullscreen>
        </iframe>
      </li>
    <?php else: ?>
      <li class="content__section section">
        <p class="section__update-date">
          <?=SYNC_ICON?><time><?=$content['date']?></time>
        </p>
        <h3 class="section__title-text section__title-text--narrow-bottom">
          <?=$content['title']?>
        </h3>
        <p class="section__label">
          <a href="./<?=$content['type']?>">≫view <?=$content['type']?> page</a>
        </p>
        <p class="section__square-image-wrapper">
          <?php if(strpos($content['fullpath'], 'mp4')): ?>
          <video
            src="<?=$content['fullpath']?>"
            poster="<?=$content['thumbnail']?>"
            controls
            playsinline
            loop
            class="section__square-image">
          </video>
          <?php else: ?>
          <a href="./<?=$content['type']?>">
            <img src="<?=$content['fullpath']?>" class="section__square-image" alt="<?=$content['text']?>">
          </a>
          <?php endif; ?>
        </p>
      </li>
    <?php endif; endforeach; ?>
    </ul>
  </section>
</main>

<?php require($root.'footer.php'); ?>
