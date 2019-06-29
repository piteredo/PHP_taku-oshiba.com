<?php
$root = '../';
$page_name = 'movie';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = $page_name;
require($root.'header.php');

$maxResults = 5;
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


<main class="main">
  <article class="content">
    <h2 class="content__header-title">
      <?=VIDEO_EN?>
    </h2>
    <p class="content__header-update-date">
      <?=SYNC_ICON?>
      <time>
        <?=$update_date?>
      </time>
    </p>

    <p class="content__description">
      <?=VIDEO_GREETING_TEXT?>
    </p>

    <ul class="content__image-list image-list">
    <?php foreach($json_decode['items'] as $video):
      $videoId = $video['snippet']['resourceId']['videoId'];
      ?>
      <li class="image-list__image">
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

    <p class="content__description content__description--right">
      <?=VIDEO_END_TEXT?>
    </p>
  </article>
</main>

<?php require($root.'footer.php'); ?>
