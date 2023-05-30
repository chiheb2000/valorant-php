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
$id = $_GET["id"];

// Suppression de l'utilisateur dans la base de données
$sql = "DELETE FROM produit WHERE id='$id'";
$sqlo = "DELETE FROM `order` WHERE id_produit='$id'";
if ($conn->query($sql) === TRUE && $conn->query($sqlo) === TRUE ) {
   
    header('Location: shop.php');
    
}
?>