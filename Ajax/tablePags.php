<?php

require_once (realpath (__DIR__ .'./../src/sql/SQLIN.php'));

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers", "Origin, X-Request-Width, Content-Type, Accept");
header('Content-Type: application/json; charset=utf-8');

$page = $_GET["page"] ?? 1;
$itemsPerPage = $_GET["itemsPerPage"] ?? 10;
$year = $_GET["year"] ?? date("Y");
$offset = ($page - 1) * $itemsPerPage;

$result = $conn->query("SELECT * FROM claims WHERE YEAR(`Data de Abertura`) = $year LIMIT $itemsPerPage OFFSET $offset");
$items = $result->fetch_all(MYSQLI_ASSOC);

$totalRows = $conn->query("SELECT COUNT(*) as count FROM claims WHERE YEAR(`Data de Abertura`) = $year")->fetch_assoc()["count"];
$totalPages = ceil($totalRows / $itemsPerPage);

foreach ($items as $row) {
    
}

http_response_code(201);
echo json_encode([
    "items" => $items,
    "totalPages" => $totalPages
], JSON_UNESCAPED_UNICODE);