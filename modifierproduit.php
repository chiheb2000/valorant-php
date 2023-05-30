<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/profile.css">
    <title>Product</title>
    <link rel="icon" href="1.png" type="image/icon type">
    <style>
            body {
    font-family: 'Poppins', sans-serif;
    background-image: url('image/video_game-valorant-yoru_valorant-1026904.jpeg');
    background-size: cover;
    background-attachment: fixed;
    height: 100vh;
}
               .adv {
    color: rgba(0, 0, 0, 0.711);
    text-align: center;
    font-family: "Audiowide", sans-serif;
    margin-left: 20px;
}
                input {
    display: inline-block;
    height: 50px;
    width: 30%;
    background-color: rgba(255, 255, 255, 0.07);
    border-radius: 10px;
    padding: 0 10px;
    margin-top: 50px;
    margin-left: 15px;
    font-size: 18px;
    font-weight: 300;
    
}
        label{
    margin-left: 15px;
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
  $produit_id = $_GET["id"];
  $sql = "SELECT * FROM user WHERE id = $user_id";
  $sqlP = "SELECT * FROM produit WHERE id = $produit_id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $r = mysqli_fetch_assoc( mysqli_query($conn, $sqlP));
  
    // Affiche les informations de l'utilisateur dans la barre de navigation
    if ($row != null && $row['role']=='admin'){
    echo "<ul>

    <li><a   href='profile.php'><i class='fa fa-fw fa-user'></i>" . $row['nom'] . "</a></li>
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
}else{
    header("Location: home.php");
}
}
else{
    header("Location: home.php");
}


?>
</nav>
    </header>

  <br><br>
    <form method="post" enctype="multipart/form-data">
        <h3>Information On Product</h3>


        <?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $prix = $_POST["prix"];
        $image = $_FILES["image"]['name'];
     
        $stock = $_POST["stock"];
    $sqlU = "UPDATE produit SET nom_produit='$nom', prix='$prix',stock=$stock WHERE id='$produit_id' ";
    
if (mysqli_query($conn, $sqlU)) {
   
    header('Location: shop.php');
    
} else {
    echo "Error updating record: " . mysqli_error($conn);
}


    }
 
    ?>
<label for=""> Produit:</label>
<input type='text'  name='nom' value= '<?php echo $r["nom_produit"]; ?>' >
<label for=""> Price (DT):</label>
<input type='number' name='prix'   value= '<?php echo $r["prix"] ; ?>'  >
<label for=""> Stock:</label>
<input   type='number'  name='stock'  value='<?php echo $r["stock"]; ?>'  />


<input name='submit' type='submit' value='Confirm' style=' height: 50px; width: 20%; font-size: 20px;padding: 5px 20px;border-radius: 20px;cursor: pointer;  background-color: #13b9e371; margin-left: 550px; ' onclick="return validateForm()">

<br><br>
 





    </form>
    <script>
function validateForm() {
    var prix = document.getElementsByName('prix')[0].value;
    var stock = document.getElementsByName('stock')[0].value;

    if (parseFloat(prix) <= 0 || isNaN(parseFloat(prix))) {
        alert('Warning: Please enter a valid price for the product!');
        return false;
    }

    if (parseInt(stock) < 0 || isNaN(parseInt(stock))) {
        alert('Warning: Please enter a valid stock quantity for the product!');
        return false;
    }

    return confirm('Are you sure you want to update this product?');
}
</script>
    
    <footer>
        <p>&copy; 2023 Copyright:</p>
        <a href="https://playvalorant.com/fr-fr/">valorant.com</a>
    </footer>
    

</body>

</html>