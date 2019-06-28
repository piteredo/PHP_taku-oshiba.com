<?php
$root = '../';
$page_name = "contact";
$_GET['robot'] = 'noindex';
$_GET['page_name'] = $page_name;
require($root.'header.php');

$update_date = getUpdateDate($pdo, $page_name);
/*$concert_data = getPDOStatement($pdo, CONTACT_CONCERT_SQL)->fetch();
$lesson_data = getPDOStatement($pdo, CONTACT_LESSON_SQL)->fetch();
$work_data = getPDOStatement($pdo, CONTACT_WORK_SQL)->fetch();
$work_play_data = getPDOStatement($pdo, CONTACT_WORK_PLAY_SQL)->fetch();
$work_play_band_data = getPDOStatement($pdo, CONTACT_WORK_PLAY_BAND_SQL)->fetchAll();
$player_prepare = getPDOPreparedStatement($pdo, PLAYER_SQL);
$work_composition_data = getPDOStatement($pdo, CONTACT_WORK_COMPOSITION_SQL)->fetch();
$work_composition_music_data = getPDOStatement($pdo, CONTACT_WORK_COMPOSITION_MUSIC_SQL)->fetchAll();
$work_design_data = getPDOStatement($pdo, CONTACT_WORK_DESIGN_SQL)->fetch();*/
?>

<main class="main">
  <article class="content">
    <h2 class="content__header-title"><?=CONTACT_EN?></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time><?=$update_date?></time></p>

    <section  class="content__section section">
      <p class="section__sentence">
        <?=CONTACT_DESCRIPTION?>
      </p>
      <p>
        <a href="mailto:<?=EMAIL_ADDRESS?>?subject=<?=EMAIL_SUBJECT?>" target="_blank"><i class="far fa-envelope"></i></a>
        <a href="mailto:<?=EMAIL_ADDRESS?>?subject=<?=EMAIL_SUBJECT?>" target="_blank"><?=EMAIL_ADDRESS?></a>
      </p>
    </section>
  </article>
</main>

<?php require($root.'footer.php'); ?>
