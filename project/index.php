<?php

session_start();

// バリデーションを取得
$valid_array = $_SESSION['valid_array'];
unset($_SESSION['valid_array']);

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
	<h1>ダイクストラ法の計算</h1>
	<form action="./result.php" method="post">
		<p style="color:red; font-size:14px;"><?= @$valid_array ?></p>
		<textarea style="display:block;width:600px;height:300px" name="array" placeholder="jsonを入れてください"></textarea>
		<div style="margin: 30px 0;">
			<select name="start" id="">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select><span style="display: inline-block; margin: 0 5px;">開始地点</span>
			
			<select name="end" id="">
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select><span style="display: inline-block; margin: 0 5px;">終了地点</span>
		</div>
		<button>最短距離を求める</button>
	</form>
</body>
</html>