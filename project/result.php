<?php

require_once './validation.php';
session_start();

$array = $_POST['array'];
$start = $_POST['start'];
$end = $_POST['end'];

// バリデーション
$validation = new Validation();
$array = $validation->valid_array($array);

// 結果を作成
$end_flag = false;
// 始点の設定
$array_status = [];
$route;
$array_status[$start] = ['is_ok' => true, 'route' => [$start], 'value' => 0];

// 回す
while ($end_flag === false) {
  foreach ($array as $key => $recode) {
    // 確定した地点
    if (isset($array_status[$key]) && $array_status[$key]['is_ok'] === true) {
      // 現在の地点の状態
      $route = $array_status[$key]['route'];
      $current_val = $array_status[$key]['value'];

      // 更新と新規
      foreach ($recode as $k => $v) {
        if ($v) {
          if (isset($array_status[$k])) {
            if ($array_status[$k]['is_ok'] === false && $array_status[$k]['value'] > $v) {
              $current_route = [...$route, $k];
              $ttl_val = $current_val + $v;
              $array_status[$k]['route'] = $current_route;
              $array_status[$k]['value'] = $ttl_val;
            }
          } else {
            $current_route = [...$route, $k];
            $ttl_val = $current_val + $v;
            $array_status[$k] = ['is_ok' => false, 'route' => $current_route, 'value' => $ttl_val]; 
          }
        }
      }
    }
  }

  // 最も小さい未確定地点を確定にする
  $count = 0;
  $current_val = 0;
  $current_key;
  foreach ($array_status as $key => $status) {
    if ($status['is_ok'] === false) {
      if ($count === 0) {
        $current_key = $key;
        $current_val = $status['value'];
        $count++;
      }

      if ($current_val > $status['value']) {
        $current_key = $key;
        $current_val = $status['value'];
      }
    }
  }
  $array_status[$current_key]['is_ok'] = true;



  // 全ての地点が確定しているか判定
  foreach ($array_status as $status) {
    if ($status['is_ok'] === false) {
      $end_flag = false;
      break;
    }

    $end_flag = true;
  }
}

// ルートの加工
$rs_route;
foreach ($array_status[$end]['route'] as $key => $route) {
  if ($key == 0) {
    $rs_route = $route;
  } else {
    $rs_route .= '-'.$route;
  }
} 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h1>結果</h1>
  <h2>ルート</h2>
  <p><?= $rs_route ?></p>
  <h2>距離</h2>
  <p><?= $array_status[$end]['value'] ?></p>
  <a href="./index.php">戻る</a>
</body>
</html>

