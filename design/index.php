<?php
$root = '../';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = 'design';
require($root.'header.php');

$pdo = initPDO();
$design_data = getPDOStatement($pdo, DESIGN_SQL)->fetchAll();
?>

<main id="main">
  <article>
    <div>
      <h2><?=DESIGN_EN?></h2>
      <p><?=SYNC_ICON?><time><?=$design_data[0]['updatedate']?></time></p>
    </div>

    <section>
      <ul>
        <?php foreach($design_data as $row): ?>
        <li>
          <a href="<?=$root.'img/design/'.$row['src'].'.jpg'?>">
            <img src="<?=$root.'img/design/'.$row['src'].'.jpg'?>" src="<?=$root.DUMMY_LOADER_IMG_PATH?>" alt="<?=$row['src']?>">
          </a>
        </li>
      <?php endforeach; ?>
      </ul>
    </section>
  </article>
</main>

<?php require($root.'footer.php'); ?>
