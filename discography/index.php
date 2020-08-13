<?php
$root = '../';
$page_name = 'discography';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = $page_name;
require($root.'header.php');

$update_date = getUpdateDate($pdo, $page_name);
$discography_data = getPDOStatement($pdo, DISCOGRAPHY_SQL)->fetchAll();
$player_prepare = getPDOPreparedStatement($pdo, PLAYER_SQL);
?>

<main class="main">
  <article class="content">
    <h2 class="content__header-title"><?=DISCOGRAPHY_EN?></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time><?=$update_date?></time></p>

    <?php foreach($discography_data as $row):
      $title = $row['title'];
      $img_url = $row['imgurl'];
      $img_fullpath = $root. 'img/design/'. $img_url. '.jpg';
      $amazon_fullpath = 'https://studiopite.theshop.jp/items/'.$row['amazonurl'];
      $performer_id_list = strListToArray($row['performeridlist']);
      $info_list = strListToArray($row['info']);
      $rec_size = $row['recsize'];
      $song_list = strListToArray($row['songlist']);
    ?>
    <section class="content__section section">
      <h3 class="section__title-text">
        <?=$title?>
      </h3>
      <p class="section__header-image">
        <img src="<?=$img_fullpath?>" alt="<?=$img_url?>">
      </p>
      <div class="discography-text-section">
        <p class="discography-text-section__amazon-logo">
          <a href="<?=$amazon_fullpath?>">ONLINE SHOP</a>
        </p>
        <ul class="discography-text-section__content">
        <?php foreach($performer_id_list as $performer_id):
          $player = getPlayerById($player_prepare, $performer_id);
          $player_name = $player['name'];
          $player_instrument = $player['instrument'];
          ?>
          <li class="discography-text-section__content-label">
            <?=$player_name?> (<?=$player_instrument?>)
          </li>
        <?php endforeach; ?>
        </ul>
        <ul class="discography-text-section__content">
        <?php foreach($info_list as $info): ?>
          <li class="discography-text-section__content-label">
            <?=$info?>
          </li>
        <?php endforeach; ?>
        </ul>
        <p class="discography-text-section__content-label">
          <?=DISCOGRAPHY_SONGS_LABEL.' ('.$rec_size.')'?>
        </p>
        <ol class="discography-text-section__content">
        <?php foreach($song_list as $song): ?>
          <li class="discography-text-section__content-label">
            <?=$song?>
          </li>
        <?php endforeach; ?>
        </ol>
      </div>
    </section>

  <?php endforeach; ?>
  </article>
</main>

<?php require($root.'footer.php'); ?>
