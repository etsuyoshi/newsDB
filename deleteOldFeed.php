<?php

if(basename($_SERVER["PHP_SELF"]) == "deleteOldFeed.php"){
    die("Error!!");
}

$query = "SELECT COUNT(*) FROM rss";
$stmt = $con->prepare($query) or die('Prepare error! 3');
$stmt->execute() or die('Execute error! 3');
$stmt->bind_result($rows);
$stmt->fetch();
$stmt->close();
$rows = intval($rows);

if($rows > $maxFeedCount){

    $query = "DELETE FROM rss ORDER BY id LIMIT ".$deleteFeedCount;
    $stmt = $con->prepare($query) or die('Prepare error! 3');
    if ($result = $stmt->execute()){
        $stmt->free_result();
    } else {
        die('Execute error! 3');
    }

    echo "削除前の総記事数：".$rows."<br/>";
    echo "削除した記事数：".$deleteFeedCount."<br/>";
    echo "削除後の総記事数：".($rows - $deleteFeedCount)."<br/>";

} else {

    echo "総記事数：".$rows."<br/>";

}