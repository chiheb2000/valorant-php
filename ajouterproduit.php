<!---Log-in-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD product</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/profile.css">
    <link rel="icon" href="1.png" type="image/icon type">
    <style>
               .adv {
    color: rgba(0, 0, 0, 0.711);
    text-align: center;
    font-family: "Audiowide", sans-serif;
    margin-left: 20px;
}
        body {
    font-family: 'Poppins', sans-serif;
    background-image: url('image/1149399.png');
    background-size: cover;
    background-attachment: fixed;
    height: 100vh;
}

        form {
    background-color: rgba(7, 6, 6, 0.336);
    position: relative;
    border-radius: 20px;
    backdrop-filter: blur(2px);
    border: 2px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
    margin: 70px 400px;
    width: 50%;
    height: auto;
}
        input {
    display: inline-block;
    height: 50px;
    width: 30%;
    background-color: rgba(255, 255, 255, 0.07);
    border-radius: 10px;
    padding: 0 10px;
    margin-top: 50px;
    margin-left: 3px;
    font-size: 18px;
    font-weight: 300;
    
}
        label{
    margin-left:2px;
    font-size: 17px;
    color: white;
    font-weight: bold;
    font-family: "Audiowide", sans-serif;
  
}
    </style>
</head>

<body>

    <header>
        <nav>
    <?php
session_start();

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "users";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
  // Récupère l'ID de l'utilisateur à partir de la session
  $user_id = $_SESSION['user_id'];

  // Connectez-vous à votre base de données ou votre stockage de données pour récupérer les informations de l'utilisateur
  // Supposons que vous avez une table "users" avec des champs "id", "nom" et "email"
 
  $sql = "SELECT * FROM user WHERE id = $user_id";
  
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  
    // Affiche les informations de l'utilisateur dans la barre de navigation
    if ($row != null && $row['role']=='admin') {
    echo "<ul>

    <li><a  href='profile.php'><i class='fa fa-fw fa-user'></i>" . $row['nom'] . "</a></li>
    <li><a class='active' href='home.php'><i class='fa fa-home'></i> Home</a></li>
    <li><a href='quiz.php'><i class='fa fa-gamepad'></i> Quiz</a></li>
    <li><a href='shop.php'><i class='fa fa-shopping-cart'></i> Shop</a></li>
    <li><a href='pannier.php'><i class='fa fa-list-ul'></i> order_list</a></li>
    <li><a href='revenus.php'><i class='fa fa-bar-chart'></i> Income</a></li>
   
    <li><a href='logout.php' onclick=\"return confirm('Are you sure you want to Logout?')\"><i class='fa fa-power-off'></i> Logout</a></li>
    <li>
        <h3 class='adv'>You don't have a place here if you don't love this game </h3>
    </li>

</ul>";
  

}
else {
    header("Location: home.php");
}
}

else{
header("Location: home.php");
}



?>
</nav>
    </header>
   
    <form method="post" enctype="multipart/form-data">
        <h3 style='font-family: "Audiowide", sans-serif;  color: #C8363E;'>New Product</h3>


      
<<label for="nom">Name of product:</label>
<input type="text" name="nom" id="nom">
<label for="prix">Price:</label>
<input type="number" name="prix" id="prix" min="0">
<label for="stock">Stock:</label>
<input type="number" name="stock" id="stock" min="0">
<label for="image">Pic of product:</label>
<input type="file" name="image" id="image">


<input name='submit' type='submit' value='ADD' onclick="return validateForm()"style=' height: 50px; width: 30%; font-size: 20px;padding: 10px 20px;border-radius: 12px;cursor: pointer;  background-color: #C8363E; margin-left: 280px;'>
<br><br>


     
    </form>
    <footer>
        <p>&copy; 2023 Copyright:</p>
        <a href="https://playvalorant.com/fr-fr/">valorant.com</a>
    </footer>
    <?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nom = $_POST["nom"];
$prix = $_POST["prix"];
$image = $_FILES["image"]['name'];
$chemin_image='produit/'. $image;
$stock = $_POST["stock"];
move_uploaded_file($_FILES["image"]['tmp_name'],$chemin_image);

$sqlU = "INSERT INTO produit (nom_produit,prix,img,stock) VALUES ('$nom', '$prix','$chemin_image','$stock') ";

if (mysqli_query($conn, $sqlU)) {

header('Location: shop.php');

} else {
echo "Error updating record: " . mysqli_error($conn);
}


}

?>
</body>
<script>
function validateForm() {
    var nom = document.getElementById('nom').value;
    var prix = document.getElementById('prix').value;
    var stock = document.getElementById('stock').value;
    var image = document.getElementById('image').value;

    if (nom.trim() === '') {
        alert('Warning: Please enter a name for the product!');
        return false;
    }

    if (prix.trim() === '' || parseFloat(prix) < 0) {
        alert('Warning: Please enter a valid price for the product!');
        return false;
    }

    if (stock.trim() === '' || parseInt(stock) < 0) {
        alert('Warning: Please enter a valid stock quantity for the product!');
        return false;
    }
    if (image.trim() === '') {
        alert('Warning: Please select an image for the product!');
        return false;
    }

    return confirm('Good : New product has been added to the shop!!');
}
</script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
</style>
</html>