<?php
$root = '../';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = 'biography';
require($root.'header.php');

$pdo = initPDO();
$bio_data = getPDOStatement($pdo, BIOGRAPHY_SQL)->fetch(); //only 1 column
$photos = getPDOStatement($pdo, PHOTO_SQL)->fetchAll();

$update_date = $bio_data['updatedate'];
$ja_name = $bio_data['janame'];
$ja_text = $bio_data['jatext'];
$en_name = $bio_data['enname'];
$en_text = $bio_data['entext'];
?>

<main>
  <div>
    <h2><?=BIOGRAPHY_EN?></h2>
    <p><?=SYNC_ICON?><time><?=$update_date?></time></p>
  </div>

  <article>
    <ul>
    <?php foreach($photos as $photo) :
      $src = $root.'img/bio/'.$photo['src'].'.jpg'; ?>
      <li>
        <a href="<?=$src?>">
          <img src="<?=$src?>" alt="<?=$en_name?>">
        </a>
      </li>
    <?php endforeach; ?>
    </ul>

    <section>
      <section>
        <p><?=$ja_name?></p>
        <p><?=$ja_text?></p>
      </section>

      <section>
        <p><?=$en_name?></p>
        <p><?=$en_text?></p>
      </section>
    </section>

  </article>
</main>

<?php require($root.'footer.php'); ?>
