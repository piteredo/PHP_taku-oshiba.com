<?php
//呼び出し元で先に const.php が読み込まれていること

function initPDO() {
  try {
    return new PDO(
      DB_DSN,
      DB_USER,
      DB_PASSWORD,
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
      ]
    );
  }
  catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage());
  }
}

function getPDOStatement($pdo, $sql) {
  return $pdo->query($sql);
}

function getPDOPreparedStatement($pdo, $sql) {
  return $pdo->prepare($sql);
}

function createUpdatedArticle($page, $date, $title, $text, $img_url, $page_url) {
  return [
    'page' => $page,
    'date' => $date,
    'title' => $title,
    'text' => $text,
    'img_url' => $img_url,
    'page_url' => $page_url
  ];
}

function dateSort($array) {
  foreach ($array as $key) {
    $date[] = strtotime($key['date']);
  }
  array_multisort($date, SORT_DESC, SORT_NUMERIC, $array);
  return $array;
}

function getDay($date) {
  $datetime = new DateTime($date);
  $week = array("日", "月", "火", "水", "木", "金", "土");
  $w = (int)$datetime->format('w');
  return $week[$w];
}

function getPerformerIdList($ids_str) {
  return preg_split("/,/", $ids_str);
}

function getPlayerById($sql, $id) {
  $sql->execute(array($id));
  return $sql->fetch();
}
?>
