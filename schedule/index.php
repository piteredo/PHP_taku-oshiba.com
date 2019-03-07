<?php
$root = '../';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = 'schedule';
require($root.'header.php');

$pdo = initPDO();
$schedule_data = getPDOStatement($pdo, SCHEDULE_SQL)->fetchAll();
foreach ($schedule_data as $v) {
  $date[] = strtotime(substr($v['date'], 0, -4));
}
array_multisort($date, SORT_ASC, SORT_NUMERIC, $schedule_data);
$place_data = getPDOStatement($pdo, PLACE_SQL)->fetchAll();
$player_prepare = getPDOPreparedStatement($pdo, PLAYER_SQL);
?>

<main id="main">
  <article>
    <div class="header">
      <h2><?=SCHEDULE_EN?></h2>
      <p class="updated-date"><?=SYNC_ICON?><time><?=$schedule_data[count($schedule_data)-1]['updatedate']?></time></p>
    </div>

    <?php foreach($schedule_data as $row): ?>
    <section class="article-section">
      <section class="text-section">
        <p class="date"><time><?=$row['date']?></time><?='&nbsp;'.getDay($row['date'])?></p>
        <?php if($row['alert'] != null): ?>
        <p class="alert"><?=$row['alert']?></p>
        <?php endif; ?>
        <h3><?=$row['title']?></h3>
        <p>
          <?php
          $place = $place_data[$row['placeid']];
          echo $place['city'].'&nbsp;';
          ?><a href="<?=$place['url']?>" target="_blank"><?=$place['name']?></a>
        </p>
        <p>
          <?php
          if($row['starttime'] != null) echo $row['starttime'].'-&nbsp;';
          if($row['opentime'] != null) echo '('.$row['opentime'].'open)&nbsp;&nbsp;';
          if($row['price'] != null) echo $row['price'];
        ?>
        </p>
          <?php if($row['other_text'] != null): ?>
          <p><?=$row['other_text']?></p>
        <?php endif; ?>
        <ul>
          <?php
          $performer_id_list = getPerformerIdList($row['performeridlist']);
          foreach($performer_id_list as $performer_id):
            $player = getPlayerById($player_prepare, $performer_id);
          ?>
          <li><a href="<?=$player['url']?>" target="_blank"><?=$player['name']?></a>&nbsp;(<?=$player['instrument']?>)</li>
        <?php endforeach; ?>
        </ul>
      </section>
      <section class="image-section">
        <p>
          <?php if($row['imgurl'] != null): ?>
          <img src="<?=$root.'img/design/'.$row['imgurl']?>" alt="<?=$row['imgurl']?>" src="<?=$root.DUMMY_LOADER_IMG_PATH?>">
        <?php endif; ?>
        </p>
      </section>
    </section>
    <?php endforeach;?>
  </article>
</main>

<?php require($root.'footer.php'); ?>
