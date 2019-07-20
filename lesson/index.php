<?php
$root = '../';
$page_name = 'lesson';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = $page_name;
require($root.'header.php');

$update_date = getUpdateDate($pdo, $page_name);
$greeting = getPDOStatement($pdo, LESSON_GREETING_SQL)->fetch(); //only 1 column
$movie = getPDOStatement($pdo, LESSON_VIDEO_SQL)->fetchAll();
$detail = getPDOStatement($pdo, LESSON_DETAIL_SQL)->fetchAll();
$contact = getPDOStatement($pdo, LESSON_CONTACT_SQL)->fetch(); //only 1 column
$image = getPDOStatement($pdo, LESSON_IMAGE_SQL)->fetchAll(); //currently only 1 column

$image_src = $image[0]['textmain_arr'];
$image_fullpath = $root.'img/'.$image[0]['textmain_arr'];
$greeting_title = $greeting['title'];
$greeting_text = $greeting['textmain_arr'];
$movie_title = $movie[0]['title'];
$detail_title = $detail[0]['title'];
$contact_title = $contact['title'];
$contact_text = $contact['textmain_arr'];
?>

<main class="main">
  <article class="content">
    <h2 class="content__header-title"><?=LESSON_SCHOOL_NAME?></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time><?=$update_date?></time></p>

    <p class="content__header-image">
      <img src="<?=$image_fullpath?>" alt"<?=$image_src?>">
    </p>

    <section class="content__section section">
      <h3 class="section__title-text">
        <?=$greeting_title?>
      </h3>
      <p class="section__sentence">
        <?=$greeting_text?>
      </p>
    </section>

    <section class="content__section section video-list lesson-section">
      <h3 class="section__title-text">
        <?=$movie_title?>
      </h3>
      <?php foreach($movie as $row):
        $title = $row['subtitle'];
        $src = $row['textmain_arr'];
      ?>
      <section class="video-list__video">
        <h4 class="lesson-section__content-title"><?=$title?></h4>
        <iframe
          src = "https://www.youtube.com/embed/<?=$src?>?rel=0"
          width = "560"
          height = "315"
          frameborder = "0"
          allow = "autoplay; encrypted-media"
          allowfullscreen>
        </iframe>
      </section>
    <?php endforeach; ?>
    </section>

    <section class="content__section section lesson-section">
      <h3 class="section__title-text">
        <?=$detail_title?>
      </h3>
      <?php for($i=0; $i<count($detail); $i++):
        $title = $detail[$i]['subtitle'];
        $texts = $detail[$i]['textmain_arr'];
        $annotations = $detail[$i]['textsub_arr'];
      ?>
      <section class="lesson-section__content">
        <h4 class="lesson-section__content-title">
          <?=$title?>
        </h4>
        <ul class="lesson-section__content-labels">
        <?php
        $texts_arr = preg_split("/,/", $texts);
        foreach($texts_arr as $text):
          ?>
          <li class="lesson-section__content-label">
            <?=$text?>
          </li>
        <?php endforeach; ?>
        </ul>
        <ul class="lesson-section__content-labels">
        <?php
        $annotations_arr = preg_split("/,/", $annotations);
        foreach($annotations_arr as $annotation):
          ?>
          <li class="lesson-section__content-label lesson-section__content-label--annotation">
            <?=$annotation?>
          </li>
        <?php endforeach; ?>
        </ul>
      </section>
      <?php endfor; ?>
    </section>

    <section class="content__section section">
      <h3 class="section__title-text">
        <?=$contact_title?>
      </h3>
      <p class="section__sentence">
        <?=$contact_text?>
      </p>
    </section>

  </article>
</main>

<?php require($root.'footer.php'); ?>
