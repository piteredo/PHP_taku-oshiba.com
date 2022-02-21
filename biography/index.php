<?php
$root = '../';
$page_name = 'biography';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = $page_name;
require($root.'header.php');

$update_date = "2021-02-20";//getUpdateDate($pdo, 'biography');
$bio_data = getPDOStatement($pdo, BIOGRAPHY_SQL)->fetch(); //only 1 column
$photos = getPDOStatement($pdo, PHOTO_SQL)->fetchAll();
$ja_name = $bio_data['janame'];
$ja_name_ruby = $bio_data['janame_ruby'];
$ja_text = $bio_data['jatext'];
$en_name = $bio_data['enname'];
$en_text = $bio_data['entext'];
?>

<main class="main">
  <article class="content">
    <h2 class="content__header-title"><?=BIOGRAPHY_EN?></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time><?=$update_date?></time></p>

    <ul class="content__header-image slider">
    <?php foreach($photos as $photo) :
      $src = $root.'img/bio/'.$photo['src'].'.jpg'; ?>
      <li class="biography-images">
        <!--<a href="<?=$src?>">-->
          <img src="<?=$src?>" class="biography-images__image" alt="<?=$en_name?>">
        <!--</a>-->
      </li>
    <?php endforeach; ?>
    </ul>

    <section>
      <article class="content__section section">
        <h3 class="section__title-text">
          <?=$ja_name?> (<?=$ja_name_ruby?>)
        </h3>
        <p class="section__sentence">
          <?=$ja_text?>
        </p>
      </article>

      <article class="content__section section">
        <h3 class="section__title-text">
          <?=$en_name?>
        </h3>
        <p class="section__sentence">
          <?=$en_text?>
        </p>
      </article>
    </section>

  </article>
</main>

<?php require($root.'footer.php'); ?>
