<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="stylesheet" href="css/profile.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Income</title>
    <link rel="icon" href="1.png" type="image/icon type">
    <style>
        body {
    font-family: 'Poppins', sans-serif;
    background-image: url('image/7047015.jpg');
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
.container {
    background-color: rgba(22, 19, 19, 0.13);
    position: relative;
    border-radius: 10px;
    backdrop-filter: blur(20px);
    border: 2px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
  
  height: auto;
  
  
}
.canvas-container{
    display: flex;
  flex-direction: row;
}
canvas {
  width:80%;
  max-width:730px ; 
}
h1{
        font-family: "Audiowide", sans-serif;
        font-size: 2.8em;
        color: #48D1CC;
       text-align: center;
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
        header("Location: home.php");
}
}

else{
    header("Location: home.php");
}


?>
</nav>
    </header>


  
<div class="container" style="margin: 80px 10px;">

<div class="canvas-container" >
        <?php

// Récupérer les données des commandes de la base de données
$query = "SELECT DATE(date_commande), SUM(somme) as revenus  FROM `order` WHERE etat = 2 GROUP BY DATE(date_commande)";
$result = mysqli_query($conn, $query);

// Organiser les données sous forme de tableaux pour Chart.js
$dates = array();
$revenues = array();
while ($row = mysqli_fetch_assoc($result)) {
    $dates[] = $row['DATE(date_commande)'];
    $revenues[] = $row['revenus'];
}

// Afficher le graphique en ligne

echo "<canvas id='revenues-chart' ></canvas>";
echo "<script>
        var ctx = document.getElementById('revenues-chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: " . json_encode($dates) . ",
                datasets: [{
                    label: 'En Dt ',
                    data: " . json_encode($revenues) .  " ,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 3
                }]
            },
            options: {
                scales: {
                    xAxes: [{
                    ticks: {
                        fontColor: 'white',
                        padding: 10 ,
                        fontSize: 15
                    },
                    gridLines: {
                        display: true,
                       
                        lineWidth: 8 // épaisseur de la ligne x
                      
                    }
                }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            fontColor: 'white',
                            fontSize: 15,
                            fontFamily: 'Verdana',
                            padding: 10 
                        },
                        gridLines: {
                            display: true,
                           
                            lineWidth: 8 // épaisseur de la ligne x
                          
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Daily Income',
                    fontSize: 30,
                    fontColor: 'black'
                }
            }
        });
    </script>";
    $query1 = "SELECT produit.nom_produit as total, SUM(`order`.quantity) as total_qte FROM `order`
    INNER JOIN produit ON `order`.`id_produit` = produit.`id` 
    WHERE etat = 2   
    GROUP BY id_produit";
    $result1 = mysqli_query($conn, $query1);
    
    // Organiser les données sous forme de tableaux pour Chart.js
    $categories = array();
    $qtes = array();
    while ($row = mysqli_fetch_assoc($result1)) {
        $categories[] = $row['total'];
        $qtes[] = $row['total_qte'];
    }
        echo "<canvas id='commandes-chart'  style='margin-left: 30px;' ></canvas>";
        echo "<script>
                var ctx = document.getElementById('commandes-chart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: " . json_encode($categories) . ",
                        datasets: [{
                           
                            data: " . json_encode($qtes) . ",
                            backgroundColor: [
                                '#ff6384',
                                '#36a2eb',
                                '#ffce56',
                                '#cc65fe',
                                '#6be0dc',
                                'brown',
                                'green',
                                'blue',
                                'red',
                                'purple',
                                '#F0F8FF',
                                '#FAEBD7',
                                '#FFD1D1',
                                '#FFE4E1',
                                '#FF00FF',
                                '#F0E68C',
                                '#87CEFA',
                                '#FF6347'			

                                


                                
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        legend: {
                            display: true,
                            labels: {
                              fontSize: 15, // taille de police pour les étiquettes de légende
                              fontColor: 'white'
                            }
                          },
                        title: {
                        display: true,
                        text: 'Sales quantity for product',
                        fontSize: 30

                    }
                    }
                });
            </script>";
        
    ?>
    </div>
    <br><br>
</div>
   <br><br> <br><br> <br><br>
    
    <footer>
        <p>&copy; 2023 Copyright:</p>
        <a href="https://playvalorant.com/fr-fr/">valorant.com</a>
    </footer>
    

</body>

</html>