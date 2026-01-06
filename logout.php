<?php
require_once 'config.php';

// Supprimer le cookie JWT
clearAuthCookie();

// Redirection vers la page de connexion
header("Location: /login.php");
exit;
?>
