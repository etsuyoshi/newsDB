<?php

header('Content-Type: text/html; charset=UTF-8');

require_once("./config/config.php");


// Load blogs
$query = "SELECT body_with_tags FROM rss";
$stmt = $con->prepare($query) or die('Prepare error! 0');
$stmt->execute() or die('Execute error! 0');
$stmt->bind_result($row);
while ($stmt->fetch()) {
    echo $row;
}
$stmt->close();

