<?php

require_once realpath(__DIR__ . '/config/tools.php');
require_once getAbsolutePath('/config/Database.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');

$database = new Database();
$db = $database->getConnection();

$query = "SELECT file_path FROM routes WHERE route_name = :route_name LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(':route_name', $uri);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $file_path = $result['file_path'];
    
    if (file_exists('app/View/' . $file_path)) {
        require_once 'app/View/' . $file_path;
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Page not found: ' . $file_path]);
    }
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Route not found']);
}
?>
