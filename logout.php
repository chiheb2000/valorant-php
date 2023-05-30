<?php
// Démarre une session
session_start();

// Détruit la session de l'utilisateur
session_destroy();

// Redirige l'utilisateur vers la page de connexion
header("Location: home.php");
exit;
?>