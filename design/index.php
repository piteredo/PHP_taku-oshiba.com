<?php
$root = '../';
$page_name = 'design';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = $page_name;
require($root.'header.php');

$num   = 30;
$query = 'media.limit('. $num. '){caption,media_url,permalink,timestamp}';
$json  = file_get_contents("{$f_api}{$ig_id}?fields={$query}&access_token={$token}");
$data  = json_decode($json, true);
$medias = $data['media']['data'];
$update_date = substr($medias[0]['timestamp'], 0, 10);
?>


<main>
  <article>
    <h2><?=DESIGN_EN?></h2>
    <p><?=SYNC_ICON?><time><?=$update_date?></time></p>

    <p><?=DESIGN_GREETING_TEXT?></p>

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
  </article>
</main>

<?php require($root.'footer.php'); ?>
