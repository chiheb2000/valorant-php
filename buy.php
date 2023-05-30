<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/buy.css">
    <link rel="icon" href="1.png" type="image/icon type">
    <title>Buy</title>
    <style>
    body {
    font-family: 'Poppins', sans-serif;
    background-image: url('image/2916745.png');
    background-size: cover;
    background-attachment: fixed;
    height: 100vh;
}

form {
    background-color: rgba(22, 19, 19, 0.13);
    position: relative;
    border-radius: 150px;
    backdrop-filter: blur(20px);
    border: 5px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
    margin: 30px 380px;
    width: 50%;
    height: auto;
}
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    padding: 0;
    background-color: transparent;
    overflow: hidden;
}

li {
    color: #2f002c;
    padding: 0rem 1.1rem;
    float: left;
}

li a {
    color: #2f002c;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: .7px;
}

li a:hover {
    color: #C8363E;
    transition: all .3s ease-in-out
}

.adv {
    color: rgba(0, 0, 0, 0.711);
    text-align: center;
    font-family: "Audiowide", sans-serif;
    margin-left: 40px;
}
input {
    display: inline-block;
    height: 50px;
    width: 30%;
    background-color: rgba(255, 255, 255, 0.07);
    border-radius: 10px;
    padding: 0 10px;
    margin-top: 40px;
    margin-left: 15px;
    font-size: 18px;
    font-weight: 300;
    
}
label{
    margin-left: 20px;
    font-size: 20px;
    color: white;
    font-weight: bold;
}
footer {
    position: relative;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 50px;
    background-color: #090303;
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

if (isset($_SESSION['user_id'])) {

  $user_id = $_SESSION['user_id'];
  $produit_id = $_GET["id"];
 
  $count_query = "SELECT COUNT(*) FROM `order` WHERE id_user = $user_id and etat <> 2";
  $count_result = mysqli_query($conn, $count_query);
  $count = mysqli_fetch_array($count_result)[0];
  $sql = "SELECT * FROM user WHERE id = $user_id";
  $sqlP = "SELECT * FROM produit WHERE id = $produit_id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
 
  $r = mysqli_fetch_assoc( mysqli_query($conn, $sqlP));
  
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
}
else{
    header("Location: log.php");
}


?>
</nav>
    </header>

        <?php 

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    
    if (isset($_POST["submit"])) {
       
    $location = $_POST["location"];
    $quantity = $_POST["quantity"];
   
     $somme = $_POST["somme"];
     $date_commande = date('Y-m-d H:i:s');
     $quantite_actuelle = $r["stock"];
     $nouvelle_quantite = $quantite_actuelle - $quantity ;
    // Vérifier la connexion
	/*if (!$mysqli) {
		die("Connection failed: " . mysqli_connect_error());
	}*/
    if($conn->connect_error){
        die("Connection failed: (" . $conn->connect_errno.")".$conn->connect_error);
    }
  
   
   
    $sqlC = "INSERT INTO `order` (`id_user`, `id_produit`, `location`, `quantity`, `somme`, `date_commande`,`etat`) VALUES ('$user_id', '$produit_id','$location','$quantity','$somme','$date_commande ',0) ";
    $sqlPU = "UPDATE produit SET stock = $nouvelle_quantite WHERE id = $produit_id";
   
if (mysqli_query($conn, $sqlC)) {
    mysqli_query($conn, $sqlPU);
    header('Location:pannier.php');
    exit;
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

}
}

?>
<form onsubmit="return v()" method="post">
        <h3>Your informations</h3>

        <label for=""> Nom:</label>
        <input type="text" value= '<?php echo $row["nom"]; ?>' disabled>
        <label for=""> E-mail:</label>
        <input type="email" value='<?php echo $row["email"]; ?>'disabled>
        <label for=""> Phone:</label>

        <input type="tel" value= '<?php echo $row["tel"]; ?>'>
        <label for=""> Location:</label>
        <input type="text" placeholder="Location" id="loc" name="location">
        <label for=""> Produit:</label>
        <input type="text" value= '<?php echo $r["nom_produit"]; ?>'disabled>
        <label for=""> Price:</label>
        <input type="text" id ="myproduit" value= '<?php echo $r["prix"] ; ?>'disabled>
        <label for=""> Stock:</label>
        <input type="number" name="stock" id ="stock" value= '<?php echo $r["stock"]; ?>'disabled>
        <label for=""> Quantity:</label>
        <input type="number"  name="quantity" id="quantity" oninput="calcul()" >
        <label style="margin-left: 190px;" for=""> Total:</label>
        <input type ="text" name="somme" id="prix" >
        
        <br><br>
        <span id="msg"> </span>
        <span id="msgL"> </span>
       
        <input name="submit" type="submit" value="Buy" style="font-size: 20px;padding: 5px 20px;margin: 40px 280px;border-radius: 25px;  background-color: #c8363d7d; cursor:pointer;" >

    </form>
    <br><br><br>
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
            msg = `<h3 style='color:red'> Your Location PLS !</h3>`;
            document.getElementById("msgL").innerHTML = msg;
            return false;
        } else {
            document.getElementById("msgL").innerHTML = msg;
            return true;
        }

    }
    /*function Qun() {
        var msg = '';
        var s = document.getElementById("stock").value;
        var q = document.getElementById("quantity").value;

       if (q<=0) {
            msg = `<h3 style='color:red'>Donnez Quantity </h3>`;
            document.getElementById("msg").innerHTML = msg;
            return false;
        }
        if ( q > s) {
            msg = "<h3 style='color:red'>La quantité commandée dépasse le stock disponible</h3>";
            document.getElementById("msg").innerHTML = msg;
            return false;
        }
        

    }*/
        function v() {
        var msg;
        if (Loc() == true &&
        calcul() == true ) {
             produit = parseInt(document.getElementById("myproduit").value);
            nbr = parseInt(document.getElementById("quantity").value);
            l = document.getElementById("loc").value
            p = parseInt(document.getElementById("quantity").value);
             s = parseInt(document.getElementById("stock").value);
            return true;

      
          /*  msg = `<p style='color:red'>Véerifiez</p>`;
            document.getElementById("msgs").innerHTML = msg;;*/
        } else {

            if (Loc() == false) {

                document.getElementById("msgL").innerHTML;
                return false;

            }
            if (
                Loc() == true &&
                calcul()  == false) {

                document.getElementById("msg").innerHTML;
                return false;
            }
            

           
        }
        return confirm('Your order has been successfully added to the cart :)')
        }
    </script>

</body>

</html>