<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Request-Width, Content-Type, Accept");

require_once (realpath (__DIR__ .'./../src/sql/SQLIN.php'));

$sql = "SELECT COUNT(`LNC`) FROM `claims` WHERE `Status` = 'Aberto'";

$QuantClaims = intval(mysqli_fetch_assoc(mysqli_query($conn, $sql))["COUNT(`LNC`)"]);
