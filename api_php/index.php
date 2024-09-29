<?php
// En-têtes HTTP pour les API et l'accès CORS (si besoin)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Inclusion du fichier de connexion à la base de données
require_once 'config/Database.php';

// Récupérer l'URL actuelle
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');

// Connexion à la base de données
$database = new Database();
$db = $database->getConnection();

// Requête pour vérifier si la route existe dans la base de données
$query = "SELECT file_path FROM routes WHERE route_name = :route_name LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(':route_name', $uri);
$stmt->execute();
// Vérifier si une route correspondante a été trouvée
if ($stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $file_path = $result['file_path'];
    
    // Vérifier si le fichier existe dans le système
    if (file_exists('app/View/' . $file_path)) {
        // Inclure le fichier correspondant et exécuter son contenu
        require_once 'app/View/' . $file_path;
    } else {
        // Si le fichier n'existe pas, retourner une erreur 404
        http_response_code(404);
        echo json_encode(['message' => 'Page not found: ' . $file_path]);
    }
} else {
    // Si aucune route n'est trouvée, retourner une erreur 404
    http_response_code(404);
    echo json_encode(['message' => 'Route not found']);
}
?>
