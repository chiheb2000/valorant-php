<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/profile.css">
    <title>Order</title>
    <link rel="icon" href="1.png" type="image/icon type">
    <style>
          body {
    font-family: 'Poppins', sans-serif;
    background-image: url('image/1149766.png');
    background-size: cover;
    background-attachment: fixed;
    height: 100vh;
}
.adv {
    color: rgba(0, 0, 0, 0.711);
    text-align: center;
    font-family: "Audiowide", sans-serif;
    margin-left: 80px;
}

        form {
    background-color: rgba(7, 6, 6, 0.336);
    position: relative;
    border-radius: 50% 20% / 10% 40%;
    backdrop-filter: blur(10px);
    border: 5px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
    margin: 20px 40px;
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
    margin-top: 40px;
    margin-left: 2px;
    font-size: 18px;
    font-weight: 300;
    color: #FFDAB9;
    font-weight: bold;
    
}
        label{
            margin-left: 1.75px;
    font-size: 17.9px;
    color: white;
    
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
  $count_query = "SELECT COUNT(*) FROM `order` WHERE id_user = $user_id and etat <> 2";
  $count_result = mysqli_query($conn, $count_query);
  $count = mysqli_fetch_array($count_result)[0];
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  
    // Affiche les informations de l'utilisateur dans la barre de navigation
    if ($row != null && $row['role']=='user') {
    echo "<ul>

    <li><a  href='profile.php'><i class='fa fa-fw fa-user'></i>" . $row['nom'] . "</a></li>
    <li><a class='active' href='home.php'><i class='fa fa-home'></i> Home</a></li>
    <li><a href='quiz.php'><i class='fa fa-gamepad'></i> Quiz</a></li>
    <li><a href='shop.php'><i class='fa fa-shopping-cart'></i> Shop</a></li>
    <li><a href='pannier.php'><i class='fa fa-shopping-basket'></i> Shoppingcart(".$count .")</a></li>

   
    <li><a href='logout.php' onclick=\"return confirm('Are you sure you want to Logout?')\"><i class='fa fa-power-off'></i> Logout</a></li>
    <li>
        <h3 class='adv'>You don't have a place here if you don't love this game </h3>
    </li>

</ul>";
  
}
else{
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
    <form onsubmit="return v()" method="post">
    <br>
        <h3 style='font-family: "Audiowide", sans-serif;  color: #CD853F;font-weight: bold;'>Your informations</h3>


        <?php

$id = $_GET["order_id"];
$sqlQ = "SELECT `order`.*, produit.*
FROM `order`
INNER JOIN produit ON `order`.`id_produit` = produit.`id`
WHERE `order`.`id` = $id ";
$res = mysqli_query($conn, $sqlQ);
  $r = mysqli_fetch_assoc($res);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $loc = $_POST["location"];
    $qun = $_POST["quantity"];
    $som = $_POST["somme"];
    $date_commande = date('Y-m-d H:i:s');
    $sqlU = "UPDATE `order` SET location='$loc', quantity='$qun',somme='$som',date_commande='$date_commande' WHERE id='$id' ";
   

$quantite_actuelle = $r["stock"];
$nouvelle_quantite = $quantite_actuelle - ($qun-$r["quantity"]);
$produit_id = $r["id_produit"];

// Mise à jour de la quantité de stock dans la table "produit"
$sqlPU = "UPDATE produit SET stock = $nouvelle_quantite WHERE id = $produit_id";
mysqli_query($conn, $sqlPU);

if (mysqli_query($conn, $sqlU)) {
   
    header('Location: pannier.php');
    
} else {
    echo "Error updating record: " . mysqli_error($conn);
}


    }
 
    ?>




<label for=""> Location</label>
<input type="text" id="loc" name="location" value= '<?php echo $r["location"]; ?>'>

<label for=""> Price product :</label>
<input type ="text" id="myproduit" value= '<?php echo $r["prix"]; ?> Dt' disabled>
<label style=" margin-left: 10px;" for=""> Stock :</label>
<input type="number"  name="stock" id="stock"  value= '<?php echo $r['stock'] + $r['quantity']; ?>'disabled>
<label style=" margin-left: 50px;" for=""> Quantity:</label>
<input type="number"  name="quantity" id="quantity" oninput="calcul()" value= '<?php echo $r["quantity"]; ?>'>
<label style=" margin-left: 200px;" for=""> Total: </label>
<input type ="text" name="somme" id="prix" value= '<?php echo $r["somme"]; ?> Dt'>



<br><br>
        <span id="msg"> </span>
        <span id="msgL"> </span>
<input name="submit" type="submit" value="Update"  style="font-size: 20px;padding: 5px 15px;margin: 20px 530px;border-radius: 25px;  background-color: #e98c0885;cursor: pointer;">
 <br><br>




    </form>
   
    
    <footer>
        <p>&copy; 2023 Copyright:</p>
        <a href="https://playvalorant.com/fr-fr/">valorant.com</a>
    </footer>
    
    <script>
   function calcul() {
    var prix = 0;
    var msg = "";
    var produit = parseInt(document.getElementById("myproduit").value);
    var nbr = parseInt(document.getElementById("quantity").value);
    var stock = parseInt(document.getElementById("stock").value);
    
    if (isNaN(nbr)) {
        msg = "<h3 style='color:red'>Please enter a valid number for the reserved quantity.</h3>";
        document.getElementById("msg").innerHTML = msg;
        return false;
    }
    
    if (nbr <= 0) {
        msg = "<h3 style='color:red'>Please enter a positive quantity greater than zero.</h3>";
        document.getElementById("msg").innerHTML = msg;
        return false;
    }
    
    if (nbr > stock) {
        msg = "<h3 style='color:red'>The quantity ordered exceeds the available stock.</h3>";
        document.getElementById("msg").innerHTML = msg;
        return false;
    }
    
    if (nbr >= stock/2 && nbr <= stock) {
        prix = produit * nbr - (produit * nbr * 0.2);
        msg = "<h3 style='color:green'>A 20% discount has been applied.</h3>";
    } else if (nbr > 0 && nbr < stock/2) {
        prix = produit * nbr;
    } else {
        msg = "<h3 style='color:red'>Input error.</h3>";
        document.getElementById("msg").innerHTML = msg;
        return false;
    }
    
    document.getElementById("msg").innerHTML = msg;
    document.getElementById("prix").value = prix + " Dt";
}

function Loc() {
        var msg = '';
        var str = document.getElementById("loc").value;

        if (str == '') {
            msg = `<h3 style='color:red'>Your Location PLS !/h3>`;
            document.getElementById("msgL").innerHTML = msg;
            return false;
        } else {
            document.getElementById("msgL").innerHTML = msg;
            return true;
        }
    }
        function v() {
        var msg;
        if (Loc() == true &&
        calcul()== true ) {

          
            produit = parseInt(document.getElementById("myproduit").value);
            nbr = parseInt(document.getElementById("quantity").value);
            l = document.getElementById("loc").value
            p = parseInt(document.getElementById("quantity").value);
             s = parseInt(document.getElementById("stock").value);
            
             

      
          /*  msg = `<p style='color:red'>Véerifiez</p>`;
            document.getElementById("msgs").innerHTML = msg;;*/
        } else {

            if (Loc() == false) {
                document.getElementById("msgL").innerHTML;
                return false;

            }
            if (
                Loc() == true &&
                calcul() == false) {
                document.getElementById("msg").innerHTML;
                return false;
            }
        }
        
        return confirm('Your order are updated');
        }
    </script>
</body>


</html>