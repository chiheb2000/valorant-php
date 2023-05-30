<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$bd = 'users';

$conn = mysqli_connect($servername, $username, $password, $bd);
if (!$conn) {
    die('Erreur : ' . mysqli_connect_error());
}
// Récupération de l'ID de l'utilisateur à supprimer
$id = $_GET["user_id"];

// Suppression de l'utilisateur dans la base de données
$sql = "DELETE FROM user WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    
    header('Location: logout.php');
}
?>