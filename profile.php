<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
    <link rel="icon" href="1.png" type="image/icon type">
    <style>
        body {
    font-family: 'Poppins', sans-serif;
    background-image: url('image/5785159.png');
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
        form {
    background-color: rgba(7, 6, 6, 0.336);
    position: relative;
    border-radius: 50px;
    backdrop-filter: blur(1px);
    border: 5px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
    margin: 10px 380px;
    width: 50%;
    height: auto;
}
        input {
    display: inline-block;
    height: 50px;
    width: 30%;
    background-color: rgba(255, 255, 255, 0.07);
    border-radius: 50px;
    padding: 0 10px;
    margin-top: 50px;
    margin-left: 5px;
    font-size: 18px;
    font-weight: 300;
    
}
        label{
    margin-left: 10px;
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

    <li><a   href='profile.php'><i class='fa fa-fw fa-user'></i>" . $row['nom'] . "</a></li>
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
    header("Location: home.php");
}


?>
</nav>
    </header>

  <br><br>
    <form method="post">
        <br>
        <h3 style='font-family: "Audiowide", sans-serif;  color: #C8363E;'>My informations</h3>


        
<label for=""> Last name:</label>
<input type='text' name='lname' value= '<?php echo $row["nom"]; ?>'  >
<label for=""> First name:</label>
<input type='text' name='fname'  value= '<?php echo $row["prenom"]; ?>'  >
<label style=" margin-left: 30px;"for=""> E-mail:</label>
<input   type='email' name='email'  value='<?php echo $row["email"]; ?>'  />
<label style=" margin-left: 35px;" for=""> Password:</label>
<input   type='text' name='password' value='<?php echo $row["pass"]; ?>'  /> 
    <!--   type='password'  Itha chema tklmt -->

<label style=" margin-left: 150px;" for=""> Phone Number:</label>
<input type='text' value= '<?php echo $row["tel"]; ?>' name='tel' />

<input name='submit' type='submit' value='Update' style=' height: 50px; width: 20%; font-size: 20px;padding: 5px 20px;border-radius: 20px;cursor: pointer;  background-color: #C8363E; margin-left: 300px;'onclick= "return confirm('Are you sure you want to change your information ?')">
<br><br>








    </form>
   
    
    <footer>
        <p>&copy; 2023 Copyright:</p>
        <a href="https://playvalorant.com/fr-fr/">valorant.com</a>
    </footer>
    <?php


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["lname"];
    $prenom = $_POST["fname"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $tel = $_POST["tel"];
    if(empty($prenom)){
        die("<h2 style='color:#f04747; text-align: center;'>Warring : Please enter your first name</h2> ");
    }
    if(empty($nom)){
        die("<h2 style='color:#f04747;text-align: center;'>Warring :Please enter your last name</h2>");
    }
    if(!isset($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
        die("<h2 style='color:#f04747;text-align: center;'>Warring :Please enter your email</h2>");
    }
    if(empty($pass)){
        die("<h2 style='color:#f04747;text-align: center;'>Warring :Please enter your password</h2>");
    }
    
    if (empty($tel)) {
        die("<h2 style='color:#f04747;text-align: center;'>Warning: Please enter your phone number</h2>");
    } elseif (strlen($tel) !== 8 || !is_numeric($tel)) {
        die("<h2 style='color:#f04747;text-align: center;'>Warning: Please enter a valid 8-digit phone number</h2>");
    }
    $sqlU = "UPDATE user SET email='$email', nom='$nom',prenom='$prenom',tel='$tel',pass='$pass' WHERE id='$user_id' ";
    
if (mysqli_query($conn, $sqlU)) {
   
    header('Location: home.php');
    
} else {
    echo "Error updating record: " . mysqli_error($conn);
}


    }
 
    ?>

</body>

</html>
