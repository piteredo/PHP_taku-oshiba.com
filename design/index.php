<?php
$root = '../';
$page_name = 'design';
$_GET['robot'] = 'noindex';
$_GET['page_name'] = $page_name;
require($root.'header.php');

$num   = 30;
$query = 'media.limit('. $num. '){caption,media_url,permalink,timestamp,thumbnail_url}';
$json  = file_get_contents("{$f_api}{$ig_id}?fields={$query}&access_token={$token}");
$data  = json_decode($json, true);
$medias = $data['media']['data'];
$update_date = substr($medias[0]['timestamp'], 0, 10);
?>


<main class="main">    

  <article class="content">
    <h2 class="content__header-title"><?=DESIGN_EN?></h2>
    <p class="content__header-update-date"><?=SYNC_ICON?><time>2021-09-15</time> (作った年代と並び順ばらばらです…いずれ整理します)</p>

    <ul class="image-list">
    <?php
      $dirpath = "../img/design/";
      $dir = opendir($dirpath);
      $file_list = array();
      $time_list = array();
      while( false !== ($file = readdir($dir))) {
        if($file[0] != "."){
          $time_list[] = filemtime($dirpath.$file);
          $file_list[] = $file;
        }
      }
      closedir($dir);
      array_multisort($time_list, SORT_DESC, $file_list);

      foreach($file_list as $filename):
        $ext = substr($filename, strrpos($filename, '.') +1);
          if( $ext == "jpg" ): ?>
            <li class="image-list__image-li">
              <a href="../img/design/<?=$filename?>">
                <img src="../img/design/<?=$filename?>" class="image-list__image">
              </a>
            </li>
          <?php endif;
      endforeach;?>
    </ul>
  </article>
</main>

<?php require($root.'footer.php'); ?>
