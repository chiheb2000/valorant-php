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
$id = $_GET["order_id"];
$date_commande = date('Y-m-d H:i:s');
$sqlU = "UPDATE `order` SET etat=  1 ,date_commande='$date_commande' where id =$id";
if (mysqli_query($conn, $sqlU) === TRUE) {
    header('Location: pannier.php');
}
?>