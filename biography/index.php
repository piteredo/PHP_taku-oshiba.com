<?php
$root = '../';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = 'biography';
require($root.'header.php');

$pdo = initPDO();
$bio_data = getPDOStatement($pdo, BIOGRAPHY_SQL)->fetch(); //only 1 column
$photos = getPDOStatement($pdo, PHOTO_SQL)->fetchAll();
?>

<main id="main">
  <article>
    <div class="header">
      <h2><?=BIOGRAPHY_EN?></h2>
      <p class="updated-date"><?=SYNC_ICON?><time><?=$bio_data['updatedate']?></time></p>
    </div>
    <ul class="slider">
      <?php foreach($photos as $photo) : ?>
      <li><a href="<?=$root.'img/bio/'.$photo['src'].'.jpg'?>"><img data-lazy="<?=$root.'img/bio/'.$photo['src'].'.jpg'?>" alt="<?=$bio_data['enname']?>"></a></li>
    <?php endforeach; ?>
    </ul>
    <div>
      <section>
        <p class="sentence"><span><?=$bio_data['janame']?></span><?=$bio_data['jatext']?></p>
      </section>

      <section>
        <p class="sentence"><span><?=$bio_data['enname']?></span><?=$bio_data['entext']?></p>
      </section>
    </div>
  </article>
</main>

<?php require($root.'footer.php'); ?>
