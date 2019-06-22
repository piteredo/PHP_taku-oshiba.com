<?php
$root = '../';
$page_name = 'movie';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = $page_name;
require($root.'header.php');

$maxResults = 50;
$address = $apiAddress . $checkId . $fragment . "&key=" . $yt_apiKey . "&maxResults=" . $maxResults;
$json = cuGet_contents( $address );
$json_decode = json_decode($json, true);

$dates = [];
foreach ($json_decode['items'] as $video) {
  $dates[] = substr($video['snippet']['publishedAt'], 0, 10);
}
rsort($dates, SORT_NUMERIC);
$update_date = $dates[0];
?>


<main>
  <article>
    <h2><?=VIDEO_EN?></h2>
    <p><?=SYNC_ICON?><time><?=$update_date?></time></p>

    <p><?=VIDEO_GREETING_TEXT?></p>

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
  </article>
</main>

<?php require($root.'footer.php'); ?>
