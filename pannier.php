<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/pannier.css">
    <title>Panier</title>
    <link rel="icon" href="1.png" type="image/icon type">
</head>
<style>
         .cd:hover {
    color: #ed252fbd;
    transition: all .3s ease-in-out
}
.cu:hover {
    color: #39e313bd;
    transition: all .3s ease-in-out
}
           .adv {
    color: rgba(0, 0, 0, 0.711);
    text-align: center;
    font-family: "Audiowide", sans-serif;
    margin-left: 20px;
}
     .cc:hover {
    color: #134ee39e;
    transition: all .3s ease-in-out
}
    table {
        width: 1450px;
        margin-block-end: relative;
    border-collapse: collapse;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 10% / 10%;
}
    .container {
        
padding: 0;
margin: 50px 40px;
vertical-align: top;
text-align: center;
}
body {
    font-family: 'Poppins', sans-serif;
    background-image: url('image/1124421.png');
    background-size: cover;
    background-attachment: fixed;
    min-height: 100vh;
    position: relative;
}



th,
td {
    padding: 15px;
    background-color: rgba(255, 255, 255, 0.2);
    color: black;
}

th {
    text-align: left;
    
}

thead th {
    background-color:#0f89cab1;
    font-family: "Audiowide", sans-serif;
    color: #6c0606e5;
    font-weight: bold;
    font-size: 1.2em;
}

tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.3);
}

tbody td {
    position: relative;
    font-size: 1em;
    font-weight: bold;
    
}

tbody td:hover:before {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    top: -9999px;
    bottom: -9999px;
    background-color: rgba(255, 255, 255, 0.2);
    z-index: -1;
}
.product-list {
    margin-left: 40px;
        list-style: none;
    
        
    }
    
    .product-list li {
        display: inline-block;
        margin:  15px;
        width: 400px;
        text-align: center;
        vertical-align: top;
        background-color: #0f89cab1;
        border-radius: 25% 10% ;
        backdrop-filter: blur(10px);
        border: 5px solid rgba(255, 255, 255, 0.1);
    }
    h1{
        font-family: "Audiowide", sans-serif;
        font-size: 2.8em;
        color: #48D1CC;
       
    }
    .product-list li h3 h4 {
        font-size: 1.2em;
        margin: 10px 0;
        color: rgba(189, 189, 189, 0.96);
    }
    footer {
    position: fixed;
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
    header("Location: log.php");
}


?>
</nav>
    </header>

    
        <?php 
        $current_time = time();
         $requete = "SELECT `order`.*, produit.nom_produit,produit.img
         FROM `order`
         INNER JOIN produit ON `order`.`id_produit` = produit.`id`
         WHERE `order`.`id_user` = $user_id ";
          $res =mysqli_query($conn, $requete);
         if ($row != null && $row['role']=='user'){

         echo "<div class='container'>
	<table>
		<thead>
			<tr >
                <th style='text-align: center;'>Date</th>
                <th style='text-align: center;'>location address</th>
				<th style='text-align: center;' >Order ID </th>
				<th style='text-align: center;'>Product Name</th>
				<th style='text-align: center;'>Quantity</th>
				<th style='text-align: center;'>Sum</th>
				<th style='text-align: center;'> Product Picture</th>
                <th colspan='2 'style='text-align: center;'>Action</th>
                <th style='text-align: center;'>Status of order</th>
                
			</tr>
		</thead>
		<tbody>";
        
       
       
       
      while( $r = mysqli_fetch_assoc($res)){
        
        if($r["etat"]==0){
            echo "<tr>
            <td>" .  $r["date_commande"] . "</td>
            <td>" . $r["location"] . "</td>
            <td>" . $r["id"] . "</td>
            <td>" . $r["nom_produit"] . "</td>
            <td>" . $r["quantity"] . "</td>
            <td>" . $r["somme"] . " Dt</td>
            <td> <img src=". $r["img"] . " style='width:80px;height:60px;'></td>

            <td> <a class='cu' href='modifierorder.php?order_id=". $r['id'] ." ' onclick=\"return confirm('Are you sure you want to edit this command?')\" style=' font-size: 1.2rem; padding: 5px 20px;border-radius: 12px;  background-color: rgba(57, 213, 22, 0.24);  '>Update</a></td>
            <td> <a class='cd'href='delete_order.php?order_id=". $r['id'] ." ' onclick=\"return confirm('Are you sure you want to delete this command ?')\" style=' font-size: 1.2rem;padding: 5px 20px;border-radius: 12px;  background-color: #c8363d71;  '>Delete</a></td>

            <td><a class='cc' href='confirmorder.php?order_id=". $r['id'] ." ' onclick=\"return confirm('Are you sure you want to confirm this command?')\" >Click to confirm</a></td>

        </tr>";

        }
        if($r["etat"]==1) {
            $current_time = time();
            $command_time = strtotime($r['date_commande']);
            $time_diff_hours = round(($current_time - $command_time) / (60 * 60), 2);
            if ($time_diff_hours < 48) {
                // Delete the command if it has not been confirmed within 48 hours
               
            
            echo "<tr style='  background-color: #66cdab9f'>
            <td>" .  $r["date_commande"] . "</td>
            <td>" . $r["location"] . "</td>
            <td>" . $r["id"] . "</td>
            <td>" . $r["nom_produit"] . "</td>
            <td>" . $r["quantity"] . "</td>
            <td>" . $r["somme"] . " Dt</td>
            <td> <img src=". $r["img"] . " style='width:80px;height:60px;'></td>
            <td> </td>
            <td> </td>
            <td>Your order are confirmed wait 48 hr </td>

            
        </tr>";

        }
        if ($time_diff_hours > 48) {
            // Delete the command if it has not been confirmed within 48 hours
           
        
        echo "<tr style='  background-color: #35b3329c'>
        <td>" .  $r["date_commande"] . "</td>
        <td>" . $r["location"] . "</td>
        <td>" . $r["id"] . "</td>
        <td>" . $r["nom_produit"] . "</td>
        <td>" . $r["quantity"] . "</td>
        <td>" . $r["somme"] . " Dt</td>
        <td> <img src=". $r["img"] . " style='width:80px;height:60px;'></td>
        <td> </td>
        <td> </td>
        <td>Your order has arrived !<br> <a class='cc' href='confirmdelivery.php?order_id=". $r['id'] ." ' onclick=\"return confirm('Thank you for trusting us :)')\" >Click to confirm</a><br><br> if not <a class='cu' href='modifierorder.php?order_id=". $r['id'] ." ' onclick=\"return confirm('Are you sure you want to edit this command?')\">Update</a> <br><br>Or <a class='cd' href='delete_order.php?order_id=". $r['id'] ." ' onclick=\"return confirm('Are you sure you want to delete this command?')\">Delete</a></td>

        
    </tr>";

    }
    } 
    /*if($r["etat"]==2) {
        echo "<tr style='  background-color: #35b3329c'>
        <td>" .  $r["date_commande"] . "</td>
        <td>" . $r["location"] . "</td>
        <td>" . $r["id"] . "</td>
        <td>" . $r["nom_produit"] . "</td>
        <td>" . $r["quantity"] . "</td>
        <td>" . $r["somme"] . " Dt</td>
        <td> <img src=". $r["img"] . " style='width:80px;height:60px;'></td>
        <td> </td>
        <td> </td>
        <td>Thank you for trusting us :)</td>

        
    </tr>";

    }*/

    }


   
    
            
	echo		"
		</tbody>
	</table>
    </div>";
}
?>

<?php 
if ($row != null && $row['role']=='admin'){
    $req = "SELECT user.nom,user.tel, `order`.*,produit.nom_produit
         FROM user
         INNER JOIN `order` ON `order`.`id_user` = user.`id`
         INNER JOIN produit ON `order`.`id_produit` = produit.`id`
         WHERE user.`role` = 'user' ORDER BY `order`.`date_commande` DESC ";
          $resulta = mysqli_query($conn,$req);
          echo "<ul class='product-list'>
          <br>
          <h1 > Order List :</h1>";

while( $ra = mysqli_fetch_assoc($resulta)){
    if($ra["etat"]==1){
    echo "
    <li>
    <br>
    <h3>User name :" .  $ra["nom"] . "</h3>
    <br>
    <h4>Phone Number :" . $ra["tel"] . "</h4>
    <br>
    <h4>Location :" . $ra["location"] . "</h4>
    <br>
    <h4>Order ID:" . $ra["id"] . "</h4>
    <br>
    <h4>Product name :" . $ra["nom_produit"] . "</h4>
    <br>
    <h4>Quantity :" . $ra["quantity"] . "</h4>
    <br>
    <h4>Total:" . $ra["somme"] . "Dt </h4>
    <br>
    <h4>Order Date :" . $ra["date_commande"] . "</h4>
    <br>
    <h4>Delivery status : En cours of Delivery</h4>
</li>";
}
if($ra["etat"]==2){
    echo "
    <li style='background-color: #35b3329c'>
    <br>
    <h3>User name :" .  $ra["nom"] . "</h3>
    <br>
    <h4>Phone Number :" . $ra["tel"] . "</h4>
    <br>
    <h4>Location :" . $ra["location"] . "</h4>
    <br>
    <h4>Order ID:" . $ra["id"] . "</h4>
    <br>
    <h4>Product name :" . $ra["nom_produit"] . "</h4>
    <br>
    <h4>Quantity :" . $ra["quantity"] . "</h4>
    <br>
    <h4>Total:" . $ra["somme"] . "Dt </h4>
    <br>
    <h4>Order Date :" . $ra["date_commande"] . "</h4>
    <br>
    <h4>Delivery status : successfully</h4>
</li>";
}

}
echo "</ul>";

}
    ?>

  
 
   <br><br><br>
    
    <footer>
        <p>&copy; 2023 Copyright:</p>
        <a href="https://playvalorant.com/fr-fr/">valorant.com</a>
    </footer>
    

</body>

</html>