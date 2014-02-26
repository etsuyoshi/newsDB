<?php

//$host['hostname'] = 'localhost'; // ホスト名
$host['hostname'] = 'mysql010.phy.lolipop.lan'; // ホスト名
//$host['user'] = 'root'; // ユーザー名
$host['user'] = 'LAA0451802'; // ユーザー名
$host['password'] = 'pswd2005'; // パスワード
$host['database'] = 'LAA0451802-test'; // データベース

$switch = true; // 巡回するかしないか
$getHatebu = true; // はてなブックマーク数を取得するかどうか
$getBody = true; // 記事の全文を取得するかどうか

$deleteOldFeed = true; // 古い記事を削除するかどうか
$maxFeedCount = 100000; // 古い記事を削除する場合、総レコード数がこの数になったら実行
$deleteFeedCount = 10000; // 古い記事を削除する場合、何件削除するか

$con = new mysqli($host['hostname'], $host['user'], $host['password'], $host['database']);
if (mysqli_connect_error()) {
    die('Connection error! : '.mysqli_connect_error());
}

$con ->set_charset("utf8");

if(basename($_SERVER["PHP_SELF"]) == "config.php"){
    die("Error!!");
}