<?php
$root = '../';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = 'lesson';
require($root.'header.php');

$pdo = initPDO();
$lesson_greeting = getPDOStatement($pdo, LESSON_GREETING_SQL)->fetch(); //only 1 column
$lesson_movie = getPDOStatement($pdo, LESSON_MOVIE_SQL)->fetchAll();
$lesson_detail = getPDOStatement($pdo, LESSON_DETAIL_SQL)->fetchAll();
$lesson_contact = getPDOStatement($pdo, LESSON_CONTACT_SQL)->fetch(); //only 1 column
$lesson_image = getPDOStatement($pdo, LESSON_IMAGE_SQL)->fetchAll(); //currently only 1 column
?>

<main id="main">
  <article>
    <div class="header">
      <h2><?=LESSON_SCHOOL_NAME?></h2>
      <p class="updated-date"><?=SYNC_ICON?><time><?=$lesson_greeting['updatedate']?></time></p>
    </div>

    <div>
      <section>
        <p><img src="<?=$root.'img/'.$lesson_image[0]['textmain_arr']?>" alt"<?=$lesson_image[0]['textmain_arr']?>"></p>
      </section>

      <section>
        <h3 class="section_title"><?=$lesson_greeting['title']?></h3>
        <p class="sentence"><?=$lesson_greeting['textmain_arr']?></p>
      </section>

      <section class="movie">
        <?php foreach($lesson_movie as $row): ?>
        <h3 class="section_title"><?=$row['title']?></h3>
        <section>
          <h4><?=$row['subtitle']?></h4>
          <iframe
            src = "https://www.youtube.com/embed/<?=$row['textmain_arr']?>?rel=0"
            width = "560"
            height = "315"
            frameborder = "0"
            allow = "autoplay; encrypted-media"
            allowfullscreen>
          </iframe>
        </section>
      <?php endforeach; ?>
      </section>

      <section class="detail">
        <h3 class="section_title"><?=$lesson_detail[0]['title']?></h3>
        <?php for($i=0; $i<count($lesson_detail); $i++): ?>
        <div class="section">
          <h4 class="section_subtitle"><?=$lesson_detail[$i]['subtitle']?></h4>
          <ul>
            <?php $textmain_arr = preg_split("/,/", $lesson_detail[$i]['textmain_arr']);
            foreach($textmain_arr as $textmain): ?>
            <li class="bold"><?=$textmain?></li>
          <?php endforeach; ?>
          </ul>
          <ul>
          <?php $textsub_arr = preg_split("/,/", $lesson_detail[$i]['textsub_arr']);
            foreach($textsub_arr as $textsub): ?>
            <li>※ <?=$textsub?></li>
          <?php endforeach; ?>
          </ul>
        </div>
        <?php endfor; ?>
      </section>

      <section>
        <p><?=$lesson_contact['textmain_arr']?></p>
      </section>
    </div>
  </article>
</main>

<?php require($root.'footer.php'); ?>
