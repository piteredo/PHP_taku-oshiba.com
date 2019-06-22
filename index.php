<?php
$root = './';
$page_name = 'index';
$_GET['robot'] = 'index';
$_GET['page_name'] = $page_name;
require($root.'header.php');

//VIDEO
$maxResults = 2;
$address = $apiAddress . $checkId . $fragment . "&key=" . $yt_apiKey . "&maxResults=" . $maxResults;
$json = cuGet_contents( $address );
$json_decode = json_decode($json, true);
$dates = [];
foreach ($json_decode['items'] as $video) {
  $dates[] = substr($video['snippet']['publishedAt'], 0, 10);
}
rsort($dates, SORT_NUMERIC);
$video_update_date = $dates[0];

//DESIGN
$num   = 3;
$query = 'media.limit('. $num. '){caption,media_url,permalink,timestamp}';
$json  = file_get_contents("{$f_api}{$ig_id}?fields={$query}&access_token={$token}");
$data  = json_decode($json, true);
$medias = $data['media']['data'];
$design_update_date = substr($medias[0]['timestamp'], 0, 10);
?>

<main>
  <section>
    <h2><?=INDEX_GREETING_TITLE?></h2>
    <p><?=INDEX_GREETING_TEXT?></p>
  </section>

  <section>
    <h2><?=VIDEO_EN?></h2>
    <p><?=SYNC_ICON?><time><?=$video_update_date?></time></p>
    <ul>
    <?php foreach($json_decode['items'] as $video):
      $videoId = $video['snippet']['resourceId']['videoId'];
      ?>
      <li>
        <iframe
          src = "https://www.youtube.com/embed/<?=$videoId?>?rel=0"
          width = "560"
          height = "315"
          frameborder = "0"
          allow = "autoplay; encrypted-media"
          allowfullscreen>
        </iframe>
      </li>
    <?php endforeach; ?>
    </ul>
  </section>

  <section>
    <h2><?=DESIGN_EN?></h2>
    <p><?=SYNC_ICON?><time><?=$design_update_date?></time></p>
    <ul>
    <?php foreach($medias as $media):
      $permalink = $media['permalink'];
      $media_url = $media['media_url'];
      $caption = deleteHashTags($media['caption']);
      ?>
      <li>
        <a href="<?=$permalink?>">
          <img src="<?=$media_url?>" alt="<?=$caption?>">
        </a>
      </li>
    <?php endforeach; ?>
    </ul>
  </section>
</main>

<?php require($root.'footer.php'); ?>
