<?php
$root = '../';
$page_name = 'schedule';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = $page_name;
require($root.'header.php');

$update_date = getUpdateDate($pdo, $page_name);
$schedule_data = getPDOStatement($pdo, SCHEDULE_SQL)->fetchAll();
$schedule_data = scheduleDateSortAsc($schedule_data, "date");
$place_data = getPDOStatement($pdo, PLACE_SQL)->fetchAll();
$player_prepare = getPDOPreparedStatement($pdo, PLAYER_SQL);
?>

<main class="main">
  <article class="content" class="content">
    <h2 class="content__header-title"><?=SCHEDULE_EN?></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time><?=$update_date?></time></p>

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
      $performer_id_list = strListToArray($row['performeridlist']);
      $img_url = $row['imgurl'];
      $img_fullpath = $root. 'img/design/'. $img_url;
    ?>
    <section class="content__section section">
      <p class="section__label">
        <time><?=$date?></time> <?=getDay($date)?>
      </p>

      <?php if($alert != null): ?>
      <p class="section__label section__label--alert">
        <?=$alert?>
      </p>
      <?php endif; ?>

      <h3 class="section__title-text">
        <?=$title?>
      </h3>

      <p class="section__label">
        <?=$place_city?> <a href="<?=$place_url?>" target="_blank"><?=$place_name?></a>
      </p>

      <p class="section__label">
        <?php
        if($start_time != null) echo $start_time . '- ';
        if($open_time != null) echo '('. $open_time. 'open)';
        if($price != null) echo ' / ' . $price;
        ?>
      </p>

      <?php if($other_text != null): ?>
      <p class="section__label">
        <?=$other_text?>
      </p>
      <?php endif; ?>

      <ul>
      <?php foreach($performer_id_list as $performer_id):
        $player = getPlayerById($player_prepare, $performer_id);
        $player_url = $player['url'];
        $player_name = $player['name'];
        $player_instrument = $player['instrument'];
        ?>
        <li class="section__label">
          <?php if($player_url != null) : ?><a href="<?=$player_url?>" target="_blank"><?php endif;?>
          <?=$player_name?><?php if($player_url != null) : ?></a> <?php endif;?>
          (<?=$player_instrument?>)
        </li>
      <?php endforeach; ?>
      </ul>

      <?php if($img_url != null): ?>
      <p class="section__schedule-image">
        <img src="<?=$img_fullpath?>" alt="<?=$img_url?>">
      </p>
      <?php endif; ?>
    </section>

  <?php endforeach;?>
  </article>
</main>

<?php require($root.'footer.php'); ?>
