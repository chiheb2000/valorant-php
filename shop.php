<!---Log-in-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/shop.css">
    <link rel="icon" href="1.png" type="image/icon type">
<style> 
 
 .product-list {
        list-style: none;
        padding: 0;
        margin: auto;
        margin-left: 80px;
    }
.btn {
        background-color: #297d3873;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        cursor: pointer;
        margin-bottom: 20px;
        text-align: center;
        font-size: 1.2em;
    }
    .adv {
    color: rgba(0, 0, 0, 0.711);
    text-align: center;
    font-family: "Audiowide", sans-serif;
    margin-left: 20px;
}
#show-form-btd {
        background-color: #ff150073;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: not-allowed;
        margin-bottom: 20px;
    }
    .product-list li {
        display: inline-block;
        margin: 40px 20px;
        width: 200px;
        text-align: center;
        vertical-align: top;
        background-color: #000000b1;
        border-radius: 10% 30% 50% 70%;
    }
    footer {
    position: relative;
    
    bottom: 0;
    width: 100%;
    height: 50px;
    background-color: #000000;
    text-align: center;
}

footer p,
a {
    color: white
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
$row = null;
// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
  // Récupère l'ID de l'utilisateur à partir de la session
  $user_id = $_SESSION['user_id'];

 
 
  $sql = "SELECT * FROM user WHERE id = $user_id";
  $count_query = "SELECT COUNT(*) FROM `order` WHERE id_user = $user_id and etat <> 2";
  $count_result = mysqli_query($conn, $count_query);
  $count = mysqli_fetch_array($count_result)[0];
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
}
else{
    echo   "<ul>

    
    <li><a class='active' href='home.php'><i class='fa fa-home'></i> Home</a></li>
    <li><a href='quiz.php'><i class='fa fa-gamepad'></i> Quiz</a></li>
    <li><a href='shop.php'><i class='fa fa-shopping-cart'></i> Shop</a></li>
    <li><a href='pannier.php'><i class='fa fa-shopping-basket'></i> Shoppingcart</a></li>
    
   
    <li><a href='log.php'><i class='fa fa-sign-in'></i> Sign in</a></li>
    <li><a href='sign.php'><i class='fa fa-user-plus'></i> Are you new ?</a></li>
    <li>
        <h3 class='adv'>You don't have a place here if you don't love this game </h3>
    </li>

</ul>";
}


?>
</nav>

    </header>
    
    <?php if ($row != null && $row['role']=='admin') {
       echo "  <div style ='text-align: center;'> <a class='btn' href='ajouterproduit.php'>Add New Product</a></div>";
        }

    ?>
    <ul class='product-list'>
    <?php
    $requete = "SELECT * FROM  produit ";
    $resultat = mysqli_query($conn, $requete);
    
        
        // Affichage des utilisateurs dans un tableau HTML
        
      
  while ($r = mysqli_fetch_assoc($resultat)) {
    $_SESSION['produit_id'] = $r['id'];
   echo "

        <li>
            <h3>" . $r["nom_produit"] . "</h3>

            <img src='" . $r["img"] . "' alt='Produit 2' style='width:180px;height:160px;'>
            <span class='price'>Price :" . $r["prix"] . " Dt</span>
            <h3>Stock : " . $r["stock"] . " </h3>";
            
            if ($row != null && $row['role']=='admin') {
                echo "
            <a id='show-form-btn' href='modifierproduit.php?id=" . $r["id"] . "'>Update</a> <br><br>
            <a  id='show-form-btn' href='supprdoduit.php?id=" . $r["id"] . "'onclick='return confirm(\"Are you sure you want to delete this product ?\")'>Delete</a></li>";
        }
        else{

        if ($r['stock']==0){
            echo "
            <a  id='show-form-btd' href=''>No Disponible</a></li>";
        }
        else{
             echo "
            <a  id='show-form-btn' href='buy.php?id=" . $r["id"] . "'>Buy Now</a></li>";
        }
          

}

}
    ?>
    </ul>
   
    <footer>
        <p>&copy; 2023 Copyright:</p>
        <a href="https://playvalorant.com/fr-fr/">valorant.com</a>
    </footer>
</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
</style>
</html>