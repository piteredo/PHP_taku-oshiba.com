<?php
$root = '../';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = 'discography';
require($root.'header.php');

$pdo = initPDO();
$discography_data = getPDOStatement($pdo, DISCOGRAPHY_SQL)->fetchAll();
$player_prepare = getPDOPreparedStatement($pdo, PLAYER_SQL);
$update_date = $discography_data[0]['updatedate'];
?>

<main>
  <div>
    <h2><?=DISCOGRAPHY_EN?></h2>
    <p><?=SYNC_ICON?><time><?=$update_date?></time></p>
  </div>

  <article>
  <?php foreach($discography_data as $row):
    $title = $row['title'];
    $img_url = $row['imgurl'];
    $img_fullpath = $root. 'img/design/'. $img_url. '.jpg';
    $amazon_fullpath = 'https://www.amazon.co.jp/dp/'.$row['amazonurl'];
    $performer_id_list = getPerformerIdList($row['performeridlist']);
    $info = $row['info'];
    $song_list = $row['songlist'];
    ?>

    <section>
      <h3><?=$title?></h3>
      <p><img src="<?=$img_fullpath?>" alt="<?=$img_url?>"></p>
      <p><a href="<?=$amazon_fullpath?>" target="_blank"><i class="fab fa-amazon"></i></a></p>
      <ul>
      <?php foreach($performer_id_list as $performer_id):
        $player = getPlayerById($player_prepare, $performer_id);
        $player_name = $player['name'];
        $player_instrument = $player['instrument'];
        ?>
        <li>
          <?=$player_name?> (<?=$player_instrument?>)
        </li>
      <?php endforeach; ?>
      </ul>
      <p><?=$info?></p>
      <p><?=$song_list?></p>
    </section>
    
  <?php endforeach; ?>
  </article>
</main>

<?php require($root.'footer.php'); ?>
