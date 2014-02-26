<?php

set_time_limit(999);
header('Content-Type: text/html; charset=UTF-8');

require_once("./config/config.php");
include("functions.php");

date_default_timezone_set('Asia/Tokyo');
mb_language("Japanese");


if(!$switch) {
    die("巡回スイッチがオフです！");
}

$blogs = array();
$blogIds = array();

// Load blogs
$query = "SELECT id,url,rss_url FROM blogs";
$stmt = $con->prepare($query) or die('Prepare error! 0');
$stmt->execute() or die('Execute error! 0');
$stmt->bind_result($rowId, $rowUrl, $rowRss);
while ($stmt->fetch()) {
    $blogs[] = $rowUrl;
    $blogIds["$rowUrl"] = $rowId;
}
$stmt->close();

// Load simplepie
require_once('simplepie/autoloader.php');
$feed = new SimplePie();
$feed->set_feed_url($blogs);
$feed->init();
$feed->handle_content_type();
$feed->set_cache_location('cache');


$count = 0;


foreach ($feed->get_items() as $item):

    $title = $item->get_title(); // 記事タイトル
    $description = $item->get_description(); // 記事概要
    $date = $item->get_date('Y-m-d H:i:s'); // 記事日付
    $id = $blogIds[$item->get_base()]; // データベース内のブログID
    $url = $item->get_permalink(); // 記事URL

    $query = "SELECT COUNT(*) FROM rss WHERE url = \"".$url."\"";
    $stmt = $con->prepare($query) or die('Prepare error! 1');
    $stmt->execute() or die('Execute error! 1');
    $stmt->bind_result($rows);
    $stmt->fetch();
    $stmt->close();
    $rows = intval($rows);

    if($rows == 0){ // If there was no article with the same url

        if (!strstr($title, 'PR:')) { // Block ad articles

            if($getHatebu) { // はてなブックマーク数
                $getHatebu = 'http://api.b.st-hatena.com/entry.count?url=' . $url;
                $hatebu = file_get_contents($getHatebu);
            } else {
                $hatebu = 0;
            }

            if($getBody){ // 記事全文
                $buf = mb_convert_encoding(@file_get_contents($url), 'UTF-8', 'auto');
                $bodyWithTags = getBlogEntryBody($buf); // タグあり
                $body = getBlogEntryBodyNT($buf); // タグなし
            } else {
                $body = "";
		$bodyWithTags = "";
            }

            $query = "INSERT INTO rss (datetime, blog_id, title, url, body_with_tags, body, hatebu) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $con->prepare($query) or die('Prepare error! 2');
            $stmt->bind_param('sissssi', $date, $id, $title, $url, $bodyWithTags, $body, $hatebu);
            if ($result = $stmt->execute()){
                $stmt->free_result();
            } else {
                die('Execute error! 2');
            }

            $count++;

        }

    }

endforeach;

echo "新規追加記事数：".$count."<br/>";

if($deleteOldFeed) include("deleteOldFeed.php");

$con->close();

echo "巡回完了！！";