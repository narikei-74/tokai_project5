<?php
class Validation 
{
  public function valid_array($array) {
    if (!$array) {
      $_SESSION['valid_array'] = '必須項目です。';
      header('Location: ./index.php');
      exit();
    }
  
    if (!json_decode($array)) {
      $_SESSION['valid_array'] = 'jsonを指定してください。';
      header('Location: ./index.php');
      exit();
    }

    $array = json_decode($array, true);
  
    if (count($array) != 10) {
      $_SESSION['valid_array'] = '要素数は10個にしてください。';
      header('Location: ./index.php');
      exit();
    }

    return $array;
  }
}