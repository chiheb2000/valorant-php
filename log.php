<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <title>Log in</title>
    <link rel="icon" href="1.png" type="image/icon type">
    <style>
        body {
    background-image: url('image/1203267.jpg');
    background-size: cover;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    font-family: 'Montserrat', sans-serif;

   
}



    </style>
</head>

<body>
<a href="home.php">
  <img src="1.png" alt="Image Button" width="70" height="70" >
</a>
        
            <form method="post" >
                <h1>WELCOME</h1>

                <input type="email" placeholder="Email" name="mail" />
                <br>
                <input type="password" placeholder="Password" name="pass" />
                <br>
                <input name="SignIn" type="submit" value="To log in" style="font-size: 20px;padding: 5px 20px;border-radius: 12px;  background-color: rgba(106, 245, 108, 0.804);">
                <br><br>
          <a href="sign.php">Create new account</a>
                <br><br>
                
               <?php 
               session_start();
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
              if  (isset($_POST["SignIn"])) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "users";
        $email = $_POST["mail"];
        $pass = $_POST["pass"];

        if(!isset($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
            die(" <h2>*Please enter your email !*</h2> ");
        }

        if(empty($pass)){
            die("<h2>*Please enter your password ! *</h2>");
        }
        
        $mysqli = new mysqli($servername, $username, $password, $database);
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }
        
        $sql = 'SELECT * FROM user WHERE email = ? AND pass = ?';
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $email, $pass);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Start a session for the user and redirect them to a protected page
            $_SESSION['user_id'] = $user['id'];
          
            header('Location: home.php');
            exit;
        } else {
            // Display an error message and allow the user to try again
        
            die("<h2>* Verify your information !</h2>");
    
        }
    }
}
    ?>
            </form>
            
     
</body>

</html>