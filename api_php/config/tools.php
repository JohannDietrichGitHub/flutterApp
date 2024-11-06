<?php
function getDotEnv() {
    $envPath = __DIR__ . '/../.env';
    if (!file_exists($envPath)) {
        throw new Exception("Le fichier .env est introuvable à l'emplacement $envPath");
    }
    
    $env = file_get_contents($envPath);
    if (empty($env)) {
        throw new Exception("Le fichier .env est vide ou n'a pas été lu correctement");
    }

    $projectRootPath = explode("\n", $env)[0];
    $projectRootPath = explode("=", $projectRootPath)[1] ?? '';

    if (empty($projectRootPath)) {
        throw new Exception("La variable PROJECT_ROOT_PATH est introuvable dans le fichier .env");
    }
    
    define('PROJECT_ROOT_PATH', $projectRootPath);
}

getDotEnv();

function getAbsolutePath($filePath): string
{
	$rootDirectory = dirname(__DIR__ . '/../../../');
	if (defined('PROJECT_ROOT_PATH')) {
		$rootDirectory = PROJECT_ROOT_PATH;
	}
	return realpath("$rootDirectory$filePath");
}
?>