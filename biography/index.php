<?php
$root = '../';
$page_name = 'biography';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = $page_name;
require($root.'header.php');

$update_date = getUpdateDate($pdo, $page_name);
$bio_data = getPDOStatement($pdo, BIOGRAPHY_SQL)->fetch(); //only 1 column
$photos = getPDOStatement($pdo, PHOTO_SQL)->fetchAll();
$ja_name = $bio_data['janame'];
$ja_name_ruby = $bio_data['janame_ruby'];
$ja_text = $bio_data['jatext'];
$en_name = $bio_data['enname'];
$en_text = $bio_data['entext'];
?>

<main>
  <article>
    <h2><?=BIOGRAPHY_EN?></h2>
    <p><?=SYNC_ICON?><time><?=$update_date?></time></p>

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
      <article>
        <h3><?=$ja_name?> (<?=$ja_name_ruby?>)</h3>
        <p><?=$ja_text?></p>
      </article>

      <article>
        <h3><?=$en_name?></h3>
        <p><?=$en_text?></p>
      </article>
    </section>

  </article>
</main>

<?php require($root.'footer.php'); ?>
