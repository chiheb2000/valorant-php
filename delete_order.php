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

$requete = "SELECT `order`.*, produit.* 
FROM `order`
INNER JOIN produit ON `order`.`id_produit` = produit.`id`
WHERE `order`.`id` = $id ";

$res = mysqli_query($conn, $requete);
$data = mysqli_fetch_assoc($res);

$quantite_actuelle = $data["stock"];
$nouvelle_quantite = $quantite_actuelle + $data["quantity"];
$produit_id = $data["id_produit"];

// Mise à jour de la quantité de stock dans la table "produit"
$sqlPU = "UPDATE produit SET stock = $nouvelle_quantite WHERE id = $produit_id";
mysqli_query($conn, $sqlPU);

// Suppression de l'utilisateur dans la base de données
$sql = "DELETE FROM `order` WHERE id='$id'";
if (mysqli_query($conn, $sql) === TRUE) {
    header('Location: pannier.php');
}
?>
