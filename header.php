<?php
// 呼び出し元で先に $root が定義されてること
$robot = $_GET['robot'];
$page_name = $_GET['page_name'];
require($root.'const.php');
require($root.'function.php');
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <title><?=SITE_TITLE?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta name="description" content="<?=SITE_DESCRIPTION?>">
    <meta name="robots" content="<?=$robot?>">

    <meta property="og:site_name" content="<?=SITE_TITLE?>">
    <meta property="og:locale" content="ja_JP">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?=SITE_TITLE?>">
    <meta property="og:description" content="<?php=SITE_DESCRIPTION?>">
    <meta property="og:image" content="<?=$root?>img/og-image.jpg">
    <meta name="twitter:site" content="@piteredo">
    <meta name="twitter:creator" content="@piteredo">
    <meta name="twitter:card" content="summary_large_image">

    <link rel="stylesheet" href="<?=$root?>css/reset.css">
    <link rel="stylesheet" href="<?=$root?>css/main.css">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
    <link rel="stylesheet" href="<?=$root?>css/slick.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/css/modaal.min.css">-->

    <link rel="icon" type="image/x-icon" href="<?=$root?>img/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=$root?>img/apple-touch-icon-180x180.png">

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="<?=$root?>js/slick.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Modaal/0.4.4/js/modaal.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script>
    <script src="<?=$root?>js/main.js"></script>
  </head>

  <body id="<?=$page_name?>">
    <header>
      <h1 class="site-title"><a href="<?=$root?>">TAKU OSHIBA</a></h1>
      <section class="lang-switcher">
        <ul>
          <li>JA</li>
          <li>EN</li>
        </ul>
      </section>
      <nav class="typical-menu">
        <ul>
          <li><a href="<?=$root.BIOGRAPHY_PAGE_PATH?>"><?=BIOGRAPHY_EN?></a></li>
          <li><a href="<?=$root.SCHEDULE_PAGE_PATH?>"><?=SCHEDULE_EN?></a></li>
          <li><a href="<?=$root.DESIGN_PAGE_PATH?>"><?=DESIGN_EN?></a></li>
          <li><a href="<?=$root.CONTACT_PAGE_PATH?>"><?=CONTACT_EN?></a></li>
          <li><a href="<?=TWITTER_URL?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
          <li><a href="<?=INSTAGRAM_URL?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
          <li><a href="<?=GITHUB_URL?>" target="_blank"><i class="fab fa-github"></i></a></li>
        </ul>
      </nav>
      <input id="ham-menu-cb" type="checkbox" value="off">
      <label id="ham-menu-icon" for="ham-menu-cb"><i class="fas fa-bars"></i></label>
      <label id="ham-menu-bg" for="ham-menu-cb"></label>
      <nav class="ham-menu">
        <ul>
          <li><a href="<?=$root.BIOGRAPHY_PAGE_PATH?>"><?=BIOGRAPHY_EN?></a></li>
          <li><a href="<?=$root.SCHEDULE_PAGE_PATH?>"><?=SCHEDULE_EN?></a></li>
          <li><a href="<?=$root.DESIGN_PAGE_PATH?>"><?=DESIGN_EN?></a></li>
          <li><a href="<?=$root.MOVIE_PAGE_PATH?>"><?=MOVIE_EN?></a></li>
          <li><a href="<?=$root.BLOG_PAGE_PATH?>"><?=BLOG_EN?></a></li>
          <li><a href="<?=$root.LESSON_PAGE_PATH?>"><?=LESSON_EN?></a></li>
          <li><a href="<?=$root.DISCOGRAPHY_PAGE_PATH?>"><?=DISCOGRAPHY_EN?></a></li>
          <li><a href="<?=$root.CONTACT_PAGE_PATH?>"><?=CONTACT_EN?></a></li>
          <li><a href="<?=TWITTER_URL?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
          <li><a href="<?=INSTAGRAM_URL?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
          <li><a href="<?=GITHUB_URL?>" target="_blank"><i class="fab fa-github"></i></a></li>
        </ul>
      </nav>
    </header>
