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
$title = $bio_data['janame'];
$text = $bio_data['jatext'];
$updates[] = array('type'=>$type, 'date'=>$date, 'fullpath'=>$fullpath, 'title'=>$title, 'text'=>$text);

//SCHEDULE
$schedule_data = getPDOStatement($pdo, SCHEDULE_SQL)->fetchAll();
$schedule_data = scheduleDateSortAsc($schedule_data, "date");
$type = 'schedule';
$date = getUpdateDate($pdo, 'schedule');
if($schedule_data[0]['imgurl'] != null) $fullpath = $root. 'img/design/'. $schedule_data[0]['imgurl'];
else $fullpath = $root. 'img/no-image.png';
$title = $schedule_data[0]['date'] . ' ' . $schedule_data[0]['title'];
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
  $title = "#";
  $text = "###";
  $updates[] = array('type'=>$type, 'date'=>$date, 'fullpath'=>$fullpath, 'title'=>$title, 'text'=>$text);
}

//DESIGN
$num   = 3;
$query = 'media.limit('. $num. '){caption,media_url,permalink,timestamp}';
$json  = file_get_contents("{$f_api}{$ig_id}?fields={$query}&access_token={$token}");
$data  = json_decode($json, true);
$medias = $data['media']['data'];
foreach ($medias as $media) {
  $type = 'design';
  $date = substr($media['timestamp'], 0, 10);
  $fullpath = $media['media_url'];
  $title = "#";
  $text = deleteHashTags($media['caption']);
  $updates[] = array('type'=>$type, 'date'=>$date, 'fullpath'=>$fullpath, 'title'=>$title, 'text'=>$text);
}

//DISCO
$discography_data = getPDOStatement($pdo, DISCOGRAPHY_SQL)->fetchAll();
$type = 'discography';
$date = getUpdateDate($pdo, 'discography');
$fullpath = $root. 'img/design/'. $discography_data[0]['imgurl']. '.jpg';
$title = $discography_data[0]['title'];
$text = "###";
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
      <li class="section">
        <h3 class="section__title-text">
          <?=$content['title']?>
        </h3>
        <p class="section__label">
          <?=$content['text']?>
        </p>
        <iframe
          src = <?=$content['fullpath']?>
          width = "560"
          height = "315"
          frameborder = "0"
          allow = "autoplay; encrypted-media"
          allowfullscreen>
        </iframe>
      </li>
    <?php else: ?>
      <li class="section">
        <h3 class="section__title-text">
          <?=$content['title']?>
        </h3>
        <p class="section__label">
          <?=$content['text']?>
        </p>
        <a href="<?=$content['fullpath']?>">
          <img src="<?=$content['fullpath']?>" alt="<?=$content['text']?>">
        </a>
      </li>
    <?php endif; endforeach; ?>
    </ul>
  </section>
</main>

<?php require($root.'footer.php'); ?>
