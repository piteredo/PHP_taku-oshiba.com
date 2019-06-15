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

$num   = 30;
$query = 'media.limit('. $num. '){media_url,permalink,timestamp}';
$json  = file_get_contents("{$f_api}{$ig_id}?fields={$query}&access_token={$token}");
$data  = json_decode($json, true);
$medias = $data['media']['data'];
$update_date = substr($medias[0]['timestamp'], 0, 10);
?>


<main>
  <div>
    <h2><?=DESIGN_EN?></h2>
    <p><?=SYNC_ICON?><time><?=$update_date?></time></p>
  </div>

  <article>
    <section>
      <p><?=DESIGN_GREETING_TEXT?></p>
    </section>

    <section>
      <ul>
      <?php foreach($medias as $media):
        $permalink = $media['permalink'];
        $media_url = $media['media_url'];
        ?>
        <li>
          <a href="<?=$permalink?>">
            <img src="<?=$media_url?>" alt="#">
          </a>
        </li>
      <?php endforeach; ?>
      </ul>
    </section>
  </article>
</main>

<?php require($root.'footer.php'); ?>
