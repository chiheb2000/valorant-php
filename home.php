
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="icon" href="1.png" type="image/icon type">
    <title>Home</title>
    <style>
        
        .adv {
    color: rgba(0, 0, 0, 0.711);
    text-align: center;
    font-family: "Audiowide", sans-serif;
    margin-left: 20px;
}
.card {
    height: 150px;
    flex: 1;
    margin: 0 2px;
    overflow: hidden;
    border-radius: 4px;
    transition: .3s;
}
.product-list {
    list-style: none;
    
    text-align: center;
}
.product-list li {
    display: inline-block;
    margin-left: 120px ;
    margin-top: 20px;
    margin-right: 200px;
    width: 80px;
    height: auto;
    text-align: center;
   
    border-radius: 30px;
}
.product-list li h3 {
    font-size: 1.5em;
    margin-left:160px;
    color: rgba(16, 224, 210, 0.96);
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

  $count_query = "SELECT COUNT(*) FROM `order` WHERE id_user = $user_id and etat <> 2";
  $count_result = mysqli_query($conn, $count_query);
  $count = mysqli_fetch_array($count_result)[0];
    // Affiche les informations de l'utilisateur dans la barre de navigation
    $row = mysqli_fetch_assoc($result);
    if ($row != null && $row['role']=='admin') {
        echo "<ul>

        <li><a style='color: green;'  href='profile.php'><i class='fa fa-user-circle-o'></i> " . $row['nom'] . "</a></li>
        <li><a class='active' href='#home'><i class='fa fa-home'></i> Home</a></li>
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

    <li><a style='color: green;' href='profile.php'><i class='fa fa-fw fa-user'></i> " . $row['nom'] . "</a></li>
    <li><a class='active' href='#home'><i class='fa fa-home'></i> Home</a></li>
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
else {
    echo "<ul>

    
    <li><a class='active' href='#home'><i class='fa fa-home'></i> Home</a></li>
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
    <br>
    <div class="art">
        <article>
            <h1 style="color: rgba(224, 16, 16, 0.96);text-align: center;">WE ARE VALORANT</h1>
            <br>
            <h3 style="color: rgba(255, 255, 255, 0.96);">DEFY THE LIMITS</h3>
            <br>
            <p style=" color: rgba(255, 255, 255, 0.96);font-weight: bold;">Blend your style and experience on a global, competitive stage. You have 13 rounds to attack and defend your side using sharp gunplay and tactical abilities. And, with one life per-round, you'll need to think faster than your opponent if you
                want to survive. Take on foes across Competitive and Unranked modes as well as Deathmatch and Spike Rush.</p>
            <br>
            <video width="500" height="200" controls autoplay style="border-radius: 30px;">
                    <source src="video/Global Open Beta How to Play Premier - VALORANT.webm" type="video/webm">
                 
                    Your browser does not support the video tag.
                  </video>
        </article>

    </div>
    <br>
    <br>
    <div style="background-color: rgba(0, 0, 0, 0.818);border-radius: 30px; backdrop-filter: blur(10px);">
        <h1 style="color: rgba(16, 224, 210, 0.96);text-align: center; ">AGENT</h1>
        <h2 style="color: rgba(16, 224, 175, 0.96);text-align: center; "> choosing the best agents for your team is more imporant than your aim !!!</h2>
        <ul class="product-list ">

            <li>
                <h3>Phoenix</h3>
                <video autoplay loop muted>
                    <source src="video/4K 60FPS Phoenix Animated Wallpaper - Valorant Fanart.webm " type="video/webm ">
                    </video>
               
            </li>
            <li>
                <h3>Raze</h3>

                <video autoplay loop muted>
                <source src="video/4K 60FPS Raze Animated Wallpaper - Valorant Fanart.webm " type="video/webm ">
            </video>
                
            </li>
            <li>
                <h3>Chamber</h3>

                <video autoplay loop muted>
            <source src="video/4K 60FPS Chamber Animated Wallpaper - Valorant Fanart.webm " type="video/webm ">
        </video>
                
            </li>
            <li>
                <h3>Neon</h3>

                <video autoplay loop muted>
            <source src="video/4K 60FPS Neon Animated Wallpaper - Valorant Fanart.webm " type="video/webm ">
        </video>
             
            </li>
            <li>
                <h3>Skye</h3>

                <video autoplay loop muted>
            <source src="video/4K 60FPS Skye Animated Wallpaper - Valorant Fanart.webm " type="video/webm ">
        </video>
            
            </li>
            <li>
                <h3>Killjoy</h3>

                <video autoplay loop muted>
            <source src="video/4K 60FPS Killjoy Animated Wallpaper - Valorant Fanart.webm " type="video/webm ">
        </video>
                
            </li>
            <li>
                <h3>Yoru</h3>

                <video autoplay loop muted>
            <source src="video/4K 60FPS Yoru Animated Wallpaper - Valorant Fanart.webm " type="video/webm ">
        </video>
               
            </li>
            <li>
                <h3>Breach</h3>

                <video autoplay loop muted>
            <source src="video/4K 60FPS Breach Animated Wallpaper - Valorant Fanart.webm " type="video/webm ">
        </video>
                
            </li>
            <li>
                <h3>Jett</h3>

                <video autoplay loop muted>
            <source src="video/4K 60FPS Jett Animated Wallpaper - Valorant Fanart.webm " type="video/webm ">
        </video>
                
            </li>
            <li>
                <h3>Cypher</h3>

                <video autoplay loop muted>
            <source src="video/4K 60FPS Cypher Animated Wallpaper - Valorant Fanart.webm" type="video/webm ">
        </video>
                
            </li>
            <li>
                <h3>Omen</h3>

                <video autoplay loop muted>
            <source src="video/4K 60FPS Omen Animated Wallpaper - Valorant Fanart.webm " type="video/webm ">
        </video>
                
            </li>
            <li>
                <h3>Reyna</h3>

                <video autoplay loop muted>
            <source src="video/4K 60FPS Reyna Animated Wallpaper - Valorant Fanart.webm " type="video/webm ">
        </video>
                
            </li>
        </ul>
        <br> <br><br> 
    </div>
    <br><br> <br>
    <div style="background-color: rgba(230, 230, 230, 0.253); backdrop-filter: blur(5px); ">
        <br>
        <h1 style="color: rgba(0, 0, 0, 0.636);text-align: center; ">Maps in the game </h1>
        <div class="container ">

            <div class="card ">
                <img alt="" src="map/1.png ">
            </div>
            <div class="card ">
                <img alt="" src="map/2.png ">
            </div>
            <div class="card ">
                <img alt="" src="map/3.png ">
            </div>
            <div class="card ">
                <img alt="" src="map/4.png ">
            </div>
        </div>
        <div class="container ">
            <div class="card ">
                <img alt="" src="map/5.png ">
            </div>
            <div class="card ">
                <img alt="" src="map/6.png ">
            </div>
            <div class="card ">
                <img alt="" src="map/7.png ">
            </div>
            <div class="card ">
                <img alt="" src="map/8.png ">
            </div>
            <div class="card ">
                <img alt="" src="map/9.png ">
            </div>
        </div>
    </div>
    <br><br> <br>


    <footer>
        <p>&copy; 2023 Copyright:</p>
        <a href="https://playvalorant.com/fr-fr/ ">valorant.com</a>
    </footer>

</script>

</body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap');
</style>

</html>