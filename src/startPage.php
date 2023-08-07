<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Request-Width, Content-Type, Accept");

require_once (realpath (__DIR__ .'./../src/sql/SQLIN.php'));

$sql = "SELECT COUNT(`LNC`) FROM `claims` WHERE `Status` = 'Aberto'";

$QuantClaims = intval(mysqli_fetch_assoc(mysqli_query($conn, $sql))["COUNT(`LNC`)"]);


if (!isset($_COOKIE['Theme'])){
    setcookie("Theme", "Day", time() + (10 * 365 * 24 * 60 * 60));
}

if (isset($_COOKIE['ThemeSession'])){
    if ($_COOKIE['ThemeSession'] == 'Moon'){
        $_COOKIE['Theme'] = 'Moon';
    } else if ($_COOKIE['ThemeSession'] == 'Sun'){
        $_COOKIE['Theme'] = 'Sun';
    }
}

if (isset($_COOKIE['Theme'])){
    if ($_COOKIE['Theme'] == 'Moon'){
        echo "<script>ThemeChange('Moon', false);</script>";
    } else if ($_COOKIE['Theme'] == 'Sun'){
        echo "<script>ThemeChange('Sun', false);</script>";
    }
}