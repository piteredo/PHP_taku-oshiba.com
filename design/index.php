<?php
$root = '../';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = 'design';
require($root.'header.php');

$pdo = initPDO();
$design_all_data = getPDOStatement($pdo, DESIGN_ALL_SQL)->fetchAll();
$design_flyer_data = getPDOStatement($pdo, DESIGN_FLYER_SQL)->fetchAll();
$design_cd_data = getPDOStatement($pdo, DESIGN_CD_SQL)->fetchAll();
$design_card_data = getPDOStatement($pdo, DESIGN_CARD_SQL)->fetchAll();
$design_web_data = getPDOStatement($pdo, DESIGN_WEB_SQL)->fetchAll();

$design_section_arr = [
  array('id'=>DESIGN_PAGE_FLYER_ID, 'title'=>DESIGN_FLYER_TITLE, 'data'=>$design_flyer_data),
  array('id'=>DESIGN_PAGE_CD_ID, 'title'=>DESIGN_CD_TITLE, 'data'=>$design_cd_data),
  array('id'=>DESIGN_PAGE_CARD_ID, 'title'=>DESIGN_CARD_TITLE, 'data'=>$design_card_data),
  array('id'=>DESIGN_PAGE_WEB_ID, 'title'=>DESIGN_WEB_TITLE, 'data'=>$design_web_data)
];
?>

<main id="main">
  <article>
    <div>
      <h2><?=DESIGN_EN?></h2>
      <p><?=SYNC_ICON?><time><?=$design_all_data[0]['updatedate']?></time></p>
    </div>

    <section>
      <p><?=DESIGN_GREETING_TEXT?></p>
      <ul>
        <?php foreach($design_section_arr as $design_section): ?>
        <li><a href="#<?=$design_section['id']?>"><?=$design_section['title']?></a></li>
      <?php endforeach; ?>
      </ul>
    </section>

    <?php foreach($design_section_arr as $design_section): ?>
    <section>
      <h3><a id="<?=$design_section['id']?>"><?=$design_section['title']?></a></h3>
      <ul>
        <?php foreach($design_section['data'] as $row): ?>
        <li>
          <a href="<?=$root.'img/design/'.$row['src'].'.jpg'?>">
            <img src="<?=$root.'img/design/'.$row['src'].'.jpg'?>" src="<?=$root.DUMMY_LOADER_IMG_PATH?>" alt="<?=$row['src']?>">
          </a>
        </li>
      <?php endforeach; ?>
      </ul>
    </section>
  <?php endforeach; ?>
  </article>
</main>

<?php require($root.'footer.php'); ?>
