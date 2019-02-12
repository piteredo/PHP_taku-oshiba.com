<?php
$root = '../';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = 'contact';
require($root.'header.php');

$pdo = initPDO();
$concert_data = getPDOStatement($pdo, CONTACT_CONCERT_SQL)->fetch();
$lesson_data = getPDOStatement($pdo, CONTACT_LESSON_SQL)->fetch();
$work_data = getPDOStatement($pdo, CONTACT_WORK_SQL)->fetch();
$work_play_data = getPDOStatement($pdo, CONTACT_WORK_PLAY_SQL)->fetch();
$work_play_band_data = getPDOStatement($pdo, CONTACT_WORK_PLAY_BAND_SQL)->fetchAll();
$player_prepare = getPDOPreparedStatement($pdo, PLAYER_SQL);
$work_composition_data = getPDOStatement($pdo, CONTACT_WORK_COMPOSITION_SQL)->fetch();
$work_composition_music_data = getPDOStatement($pdo, CONTACT_WORK_COMPOSITION_MUSIC_SQL)->fetchAll();
$work_design_data = getPDOStatement($pdo, CONTACT_WORK_DESIGN_SQL)->fetch();
?>

<main id="main">
  <article>
    <div>
      <h2><?=CONTACT_JA?></h2>
      <p><?=SYNC_ICON?><time><?=$concert_data['updatedate']?></time></p>
    </div>

    <div>
      <section>
        <p><?=CONTACT_DESCRIPTION?></p>
        <p>
          <a href="mailto:<?=EMAIL_ADDRESS?>?subject=<?=EMAIL_SUBJECT?>" target="_blank"><i class="far fa-envelope"></i></a>
          <a href="mailto:<?=EMAIL_ADDRESS?>?subject=<?=EMAIL_SUBJECT?>" target="_blank"><?=EMAIL_ADDRESS?></a>
        </p>
      </section>

      <section>
        <section>
          <h3><?=$concert_data['title']?></h3>
          <p><?=$concert_data['text']?></p>
        </section>

        <section>
          <h3><?=$lesson_data['title']?></h3>
          <p><?=$lesson_data['text']?></p>
        </section>

        <section>
          <h3><?=$work_data['title']?></h3>
          <p><?=$work_data['text']?></p>
          <section>
            <h4><?=$work_play_data['title']?></h4>
            <p><?=$work_play_data['text']?></p>
            <section>
              <h5><?=CONTACT_BAND_DESCRIPTION?></h5>
              <?php foreach($work_play_band_data as $row): ?>
              <section>
                <h6><?=$row['title']?></h6>
                <ul>
                  <?php
                  $performer_id_list = preg_split("/,/", $row['text']);
                  foreach($performer_id_list as $performer_id):
                    $player_prepare->execute(array($performer_id));
                    $player = $player_prepare->fetch();
                  ?>
                  <li><?=$player['name']?></a>&nbsp;(<?=$player['instrument']?>)</li>
                <?php endforeach; ?>
                </ul>
                <iframe
                  src = "https://www.youtube.com/embed/<?=$row['youtube_id']?>?rel=0"
                  width = "560"
                  height = "315"
                  frameborder = "0"
                  allow = "autoplay; encrypted-media"
                  allowfullscreen>
                </iframe>
              </section>
            <?php endforeach; ?>
            </section>
          </section>

          <section>
            <h4><?=$work_composition_data['title']?></h4>
            <p><?=$work_composition_data['text']?></p>
            <?php foreach($work_composition_music_data as $row): ?>
            <section>
              <h5><?=$row['title']?></h5>
              <iframe
                src = "https://www.youtube.com/embed/<?=$row['youtube_id']?>?rel=0"
                width = "560"
                height = "315"
                frameborder = "0"
                allow = "autoplay; encrypted-media"
                allowfullscreen>
              </iframe>
            </section>
          <?php endforeach; ?>
          </section>

          <section>
            <h4><?=$work_design_data['title']?></h4>
            <p><?=$work_design_data['text']?></p>
          </p>
        </section>
      </section>
    </div>
  </article>
</main>

<?php require($root.'footer.php'); ?>
