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

$update_date = $schedule_data[count($schedule_data)-1]['updatedate'];
?>

<main>
  <div>
    <h2><?=SCHEDULE_EN?></h2>
    <p><?=SYNC_ICON?><time><?=$update_date?></time></p>
  </div>

  <article>
  <?php foreach($schedule_data as $row):
    $date = $row['date'];
    $alert = $row['alert'];
    $title = $row['title'];
    $place = $place_data[$row['placeid']];
    $place_city = $place['city'];
    $place_url = $place['url'];
    $place_name = $place['name'];
    $start_time = $row['starttime'];
    $open_time = $row['opentime'];
    $price = $row['price'];
    $other_text = $row['other_text'];
    $performer_id_list = getPerformerIdList($row['performeridlist']);
    $img_url = $row['imgurl'];
    $img_fullpath = $root. 'img/design/'. $img_url;
    ?>

    <section>
      <p>
        <time><?=$date?></time>
        <?=getDay($date)?>
      </p>

      <?php if($alert != null): ?>
      <p><?=$alert?></p>
      <?php endif; ?>

      <h3><?=$title?></h3>

      <p>
        <?=$place_city?>
        <a href="<?=$place_url?>" target="_blank"><?=$place_name?></a>
      </p>

      <p>
        <?php if($starttime != null) echo $starttime; ?>
        <?php if($opentime != null) echo '('. $opentime. 'open)'; ?>
        <?php if($price != null) echo $price; ?>
      </p>

      <?php if($other_text != null): ?>
      <p><?=$other_text?></p>
      <?php endif; ?>

      <ul>
      <?php foreach($performer_id_list as $performer_id):
        $player = getPlayerById($player_prepare, $performer_id);
        $player_url = $player['url'];
        $player_name = $player['name'];
        $player_instrument = $player['instrument'];
        ?>
        <li>
          <a href="<?=$player_url?>" target="_blank"><?=$player_name?></a>
          (<?=$player_instrument?>)
        </li>
      <?php endforeach; ?>
      </ul>
    </section>

    <section>
      <p>
      <?php if($imgurl != null): ?>
        <img src="<?=$img_fullpath?>" alt="<?=$imgurl?>">
      <?php endif; ?>
      </p>
    </section>

  <?php endforeach;?>
  </article>
</main>

<?php require($root.'footer.php'); ?>
