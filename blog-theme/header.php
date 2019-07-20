<?php
// 呼び出し元で先に $root が定義されてること
$robot = $_GET['robot'];
$page_name = $_GET['page_name'];
require($root.'const.php');
require($root.'function.php');
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <?php
  require('header_head.php');
  require('header_body.php');
  $pdo = initPDO();
  ?>
