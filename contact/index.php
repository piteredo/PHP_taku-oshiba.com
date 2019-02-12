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
$work_composition_data = getPDOStatement($pdo, CONTACT_WORK_COMPOSITION_SQL)->fetch();
$work_composition_music_data = getPDOStatement($pdo, CONTACT_WORK_COMPOSITION_MUSIC_SQL)->fetchAll();
$work_design_data = getPDOStatement($pdo, CONTACT_WORK_DESIGN_SQL)->fetch();
?>

<main id="main">
  <article>
    <div>
      <h2><?=CONTACT_JA?></h2>
      <p><?=SYNC_ICON?><time><?=$contact_data['updatedate']?></time></p>
    </div>

    <div>
      <section>
        <p><?=CONTACT_DESCRIPTION?></p>
        <p><a href="mailto:<?=EMAIL_ADDRESS?>?subject=<?=EMAIL_SUBJECT?>" target="_blank"><i class="far fa-envelope"></i>&nbsp;<?=EMAIL_ADDRESS?></a></p>
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
              <section>
                <h6><?=$work_play_band_data[0]['title']?></h6>
                <ul>
                  <li></li>
                </ul>
                <iframe
                  src = "https://www.youtube.com/embed/<?=$work_play_band_data[0]['youtube_id']?>?rel=0"
                  width = "560"
                  height = "315"
                  frameborder = "0"
                  allow = "autoplay; encrypted-media"
                  allowfullscreen>
                </iframe>
              </section>

              <section>
                <h6><?=$work_play_band_data[1]['title']?></h6>
                <ul>
                  <li></li>
                </ul>
                <iframe
                  src = "https://www.youtube.com/embed/<?=$work_play_band_data[1]['youtube_id']?>?rel=0"
                  width = "560"
                  height = "315"
                  frameborder = "0"
                  allow = "autoplay; encrypted-media"
                  allowfullscreen>
                </iframe>
              </section>

              <section>
                <h6><?=$work_play_band_data[2]['title']?></h6>
                <ul>
                  <li></li>
                </ul>
                <iframe
                  src = "https://www.youtube.com/embed/<?=$work_play_band_data[2]['youtube_id']?>?rel=0"
                  width = "560"
                  height = "315"
                  frameborder = "0"
                  allow = "autoplay; encrypted-media"
                  allowfullscreen>
                </iframe>
              </section>

              <section>
                <h6><?=$work_play_band_data[3]['title']?></h6>
                <ul>
                  <li></li>
                </ul>
                <iframe
                  src = "https://www.youtube.com/embed/<?=$work_play_band_data[3]['youtube_id']?>?rel=0"
                  width = "560"
                  height = "315"
                  frameborder = "0"
                  allow = "autoplay; encrypted-media"
                  allowfullscreen>
                </iframe>
              </section>
            </section>
          </section>

          <section>
            <h4><?=$work_composition_data['title']?></h4>
            <p><?=$work_composition_data['text']?></p>
            <section>
              <h5><?=$work_composition_music_data[0]['title']?></h5>
              <iframe
                src = "https://www.youtube.com/embed/<?=$work_composition_music_data[0]['youtube_id']?>?rel=0"
                width = "560"
                height = "315"
                frameborder = "0"
                allow = "autoplay; encrypted-media"
                allowfullscreen>
              </iframe>
            </section>
            <section>
              <h5><?=$work_composition_music_data[1]['title']?></h5>
              <iframe
                src = "https://www.youtube.com/embed/<?=$work_composition_music_data[1]['youtube_id']?>?rel=0"
                width = "560"
                height = "315"
                frameborder = "0"
                allow = "autoplay; encrypted-media"
                allowfullscreen>
              </iframe>
            </section>
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
