<?php
$root = '../';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = 'discography';
require($root.'header.php');

$pdo = initPDO();
$discography_data = getPDOStatement($pdo, DISCOGRAPHY_SQL)->fetchAll();
$player_prepare = getPDOPreparedStatement($pdo, PLAYER_SQL);
?>

<main id="main">
  <article>
    <div class="header">
      <h2><?=DISCOGRAPHY_EN?></h2>
      <p class="updated-date"><?=SYNC_ICON?><time><?=$discography_data[0]['updatedate']?></time></p>
    </div>

    <?php foreach($discography_data as $row): ?>
    <section>
      <h3><?=$row['title']?></h3>
      <p><img src="<?=$root.'img/design/'.$row['imgurl'].'.jpg'?>" src="<?=$root.DUMMY_LOADER_IMG_PATH?>" alt="<?=$row['imgurl']?>"></p>
      <div>
        <a href="<?='https://www.amazon.co.jp/dp/'.$row['amazonurl']?>" target="_blank"><i class="fab fa-amazon"></i></a>
        <ul>
          <?php
          $performer_id_list = getPerformerIdList($row['performeridlist']);
          foreach($performer_id_list as $performer_id):
            $player = getPlayerById($player_prepare, $performer_id);
          ?>
          <li><?=$player['name']?>&nbsp;(<?=$player['instrument']?>)</li>
        <?php endforeach; ?>
        </ul>
        <p><?=$row['info']?></p>
        <p><?=$row['songlist']?></p>
      </div>
    </section>
    <?php endforeach; ?>
  </article>
</main>

<?php require($root.'footer.php'); ?>
