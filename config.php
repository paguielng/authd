<?php
/**
 * Configuration du site
 * Remplacez les valeurs ci-dessous par vos propres identifiants Supabase.
 */

// Mot de passe commun pour l'accès au site
define('ACCESS_PASSWORD', 'mon_mot_de_passe_secret');

// Configuration Supabase
define('SUPABASE_URL', 'https://VOTRE_PROJET_ID.supabase.co');
define('SUPABASE_SERVICE_ROLE_KEY', 'VOTRE_SERVICE_ROLE_KEY');
define('SUPABASE_BUCKET_NAME', 'uploads');

// Paramètres d'upload
define('MAX_FILE_SIZE', 50 * 1024 * 1024); // 50 Mo
define('ALLOWED_EXTENSIONS', [
    'jpg', 'jpeg', 'png', 'gif', // Images
    'pdf',                       // Documents
    'mp3', 'wav', 'ogg'          // Sons
]);

// Démarrage de la session
session_start();

/**
 * Fonction pour vérifier si l'utilisateur est connecté
 */
function check_auth() {
    if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
        header('Location: login.php');
        exit;
    }
}
?>
