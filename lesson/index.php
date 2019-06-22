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
$contact_text = $contact['textmain_arr'];
?>

<main>
  <article>
    <h2><?=LESSON_SCHOOL_NAME?></h2>
    <p><?=SYNC_ICON?><time><?=$update_date?></time></p>

    <p><img src="<?=$image_fullpath?>" alt"<?=$image_src?>"></p>

    <section>
      <h3><?=$greeting_title?></h3>
      <p><?=$greeting_text?></p>
    </section>

    <section>
      <h3><?=$movie_title?></h3>
      <?php foreach($movie as $row):
        $title = $row['subtitle'];
        $src = $row['textmain_arr'];
      ?>
      <section>
        <h4><?=$title?></h4>
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

    <section>
      <h3><?=$detail_title?></h3>
      <?php for($i=0; $i<count($detail); $i++):
        $title = $detail[$i]['subtitle'];
        $texts = $detail[$i]['textmain_arr'];
        $annotations = $detail[$i]['textsub_arr'];
        ?>
      <section>
        <h4><?=$title?></h4>
        <ul>
        <?php
        $texts_arr = preg_split("/,/", $texts);
        foreach($texts_arr as $text):
          ?>
          <li><?=$text?></li>
        <?php endforeach; ?>
        </ul>
        <ul>
        <?php
        $annotations_arr = preg_split("/,/", $annotations);
        foreach($annotations_arr as $annotation):
          ?>
          <li><?=$annotation?></li>
        <?php endforeach; ?>
        </ul>
      </section>
      <?php endfor; ?>
    </section>

    <section>
      <p><?=$contact_text?></p>
    </section>

  </article>
</main>

<?php require($root.'footer.php'); ?>
