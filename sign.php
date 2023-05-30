
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Sofia|Trirong">
    <link rel="icon" href="1.png" type="image/icon type">
    <link rel="stylesheet" href="sig.css">

    <title>Create Account</title>
    <style>
        body {
    background-image: url('image/1212384.png');
    background-size: cover;
    display: flex;
    background-attachment: fixed;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    font-family: 'Montserrat', sans-serif;
}
        form {
            
   /* background-image: url('image/video_game-valorant-yoru_valorant-1026904.jpeg');*/
    position: relative;
    backdrop-filter: blur(10px);
    background-color: #0000006b;
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    background-position: 0 0;
    border-radius: 25% 10%;;
    border: 5px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
   
   
    width: 40%;
  
    text-align: center;
    height: auto;
}
input {
    display: inline-block;
    background-color: #e9e0e080;
    border-radius: 10px 100px / 120px;
    border: none;
    padding: 12px 15px;
    margin-top: 30px;
    margin-left: 1px;
    height: 40px;
    width: 50%;
    font-size: 20px;
   
    font-weight: bold;
    
}

::placeholder {
    color: #05040480;
    
}
        p {
    font-size: 15px;
    font-weight: bold;
    line-height: 20px;
    letter-spacing: 0.5px;
}
        .btn {
        background-color: #297d3873;
        color: #fff;
        border: none;
        padding: 10px 20px;
        margin-right: 400px;
        border-radius: 20px;
        cursor: pointer;
        margin-bottom: 20px;
        text-align: center;
        font-size: 1.2em;
    }
   
    </style>
</head>

<body>

<a href="home.php">
  <img src="1.png" alt="Image Button" width="70" height="70" >
</a>
            <form onsubmit="return v()" method="post">
            <br>
            <a class='btn' href='log.php'>I have a account </a>
                <h1 style='font-family: "Audiowide", sans-serif;  color: white;'>Create Account</h1>
                <p id="msgs"> </p>
                <input id="fname" name="fname" type="text" oninput="nameV()" placeholder="First Name" />
                <p id="msg2"> </p>
                <input id="lname" name="lname" type="text" oninput="PrenomV()" placeholder="Last Name" />
                <p id="msg4"> </p>
                <input id="email" type="email" placeholder="Email" name="email" oninput="EmailV()" /><p id="msgE"> </p>
                <input type="password" placeholder="Password" id="password" name="password" oninput="validate()" />
                <p id="msg"></p >
                <input type="password" placeholder="Confirm Password" id="Cpassword" name="Cpassword" oninput="validateConfirm()" />

                <p id="msgC"></p >
                <input type="tel" placeholder="Phone" name="tel" id="tel" oninput="PhoneV()"/>
                <p id="msgP"></p >
                <input name="submit" type="submit" value="Submit" style=" cursor:pointer;  width: 20% ; font-size: 20px;padding: 5px 20px;border-radius: 12px;  background-color: #77ef73c7;">
                <br><br>
                <?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    if (isset($_POST["submit"])) {
        $servername = 'localhost';
	$username = 'root';
	$password = '';
	$database = "users";
    $prenom = $_POST["fname"];
    $nom = $_POST["lname"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $tel = $_POST["tel"];
	$mysqli = mysqli_connect($servername, $username, $password, $database);
    // Vérifier la connexion
	/*if (!$mysqli) {
		die("Connection failed: " . mysqli_connect_error());
	}*/
    if($mysqli->connect_error){
        die("Connection failed: (" . $mysqli->connect_errno.")".$mysqli->connect_error);
    }
  
    if(empty($prenom)){
        die("Please enter your first name ");
    }
    if(empty($nom)){
        die("Please enter your last name");
    }
    if(!isset($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
        die("Please enter your email");
    }
    if(empty($pass)){
        die("Please enter your password");
    }
    
    if(empty($tel)){
        die("Please enter your phone ");
    }
    $sqlE = "SELECT COUNT(*) AS count FROM user WHERE email = '$email'";
    $result = mysqli_query($mysqli, $sqlE);
    $row = mysqli_fetch_assoc($result);
    if ($row['count'] > 0) {
        // L'adresse e-mail existe déjà dans la base de données
        echo   '<script>alert("Cette adresse e-mail est déjà enregistrée.");</script>';
     
    
    } else {
    $sql = "INSERT INTO user (nom,prenom,email,pass,tel,role) VALUES ('$nom', '$prenom','$email', '$pass','$tel','user')";
    if (mysqli_query($mysqli, $sql)) {
        $query = "SELECT * FROM user WHERE email='$email' AND pass='$pass'";
$result = mysqli_query($mysqli, $query);
if(mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_array($result);
    $_SESSION['user_id'] = $user['id'];
}

        header("Location:home.php");
    } else {
        echo "Erreur: " . mysqli_error($mysqli);
    }
    mysqli_close($mysqli);
    } 
}
}

?>
</form>
          
</body>

<script>
    function EmailV() {
        var msg = '';
        const emailInput = document.getElementById("email").value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(emailInput)) {
            msg = `<p style='color:red'>Please enter a valid email address</p>`;
            document.getElementById("msgE").innerHTML = msg;

            // Or you could set an error message next to the input, change the input's style, etc.
            return false;
        } else {
            document.getElementById("msgE").innerHTML = msg;
            return true;
        }
    }

    function PrenomV() {
        var msg = '';
        var str = document.getElementById("lname").value;

        if (str == '') {
            msg = `<p style='color:red'>Please enter your first name </p>`;
            document.getElementById("msg4").innerHTML = msg;
            return false;
        } else {
            document.getElementById("msg4").innerHTML = msg;
            return true;
        }

    }

    function nameV() {
        var msg = '';
        var str = document.getElementById("fname").value;

        if (str.length < 2) {
            msg = `<p style='color:red'>Enter your name: at least 2 characters.</p>`;
            document.getElementById("msg2").innerHTML = msg;
            return false;
        } else {
            document.getElementById("msg2").innerHTML = msg;
            return true;
        }

    }



    function validate() {
        var msg = "";
        var str = document.getElementById("password").value;
        if (
            str.match(/[0-9]/g) &&
            str.match(/[A-Z]/g) &&
            str.match(/[a-z]/g) &&
            str.match(/[^a-zA-Z\d]/g) &&
            str.length >= 8
        ) {
            msg = `<p style='color:green'>Strong password :) </p>`;
            document.getElementById("msg").innerHTML = msg;
            return true;
        } else {

            msg = `
          <div style='color:red  ' >
            <p style='color:red'>Weak Password !! :</p>
            <br>
          <p>* At least 1 uppercase character.</p>
          <br>
          <p>* At least 1 lowercase character.</p>
          <br>
        <p>* At least 1 number.</p>
        <br>
        <p>* At least 1 special character.</p>
        <br>
        <p>* Minimum 8 characters.</p>
          </div>`;
            document.getElementById("msg").innerHTML = msg;
            return false;
        }
    }

    function validateConfirm() {
        var msg = "";
        var pass = document.getElementById("password").value;
        var Confrpass = document.getElementById("Cpassword").value;
        if (pass !== Confrpass) {
            msg = `<p style='color:red'>Verify your password  :( </p>`;
            document.getElementById("msgC").innerHTML = msg;
            return false;
        } else {
            msg = `<p style='color:green'>Correct  :) </p>`;
            document.getElementById("msgC").innerHTML = msg;
            return true;
        }
    }
    function PhoneV() {
     
        
        var msg = '';
        var tel = document.getElementById("tel").value;
        const phoneFormat = /^\d{8}$/;
        const isPhoneValid = phoneFormat.test(tel);
        if (!isPhoneValid) {
            msg = `<p style='color:red'>Please enter your correct Phone number </p>`;
            document.getElementById("msgP").innerHTML = msg;
            return false;
        } else {
            msg = `<p style='color:green'>Correct   :) </p>`;
            document.getElementById("msgP").innerHTML = msg;
            return true;
        }

    }



    function v() {
        var msg;

        if (validate() == true &&
            nameV() == true &&
            PrenomV() == true &&
            EmailV() == true &&
            validate() == true &&
            validateConfirm() == true &&
            
            PhoneV() == true) {

            n = document.getElementById("fname").value
            p = document.getElementById("lname").value
            e = document.getElementById("email").value
            m = document.getElementById("password").value
            c = document.getElementById("Cpassword").value
            t = document.getElementById("tel").value
            

            return true;
        } else {
          /*  msg = `<p style='color:red'>Véerifiez</p>`;
            document.getElementById("msgs").innerHTML = msg;;*/


            if (nameV() == false) {

                document.getElementById("msg2").innerHTML;

            }
            if (
                nameV() == true &&
                PrenomV() == false) {

                document.getElementById("msg4").innerHTML;

            }
            if (
                nameV() == true &&
                PrenomV() == true &&

                EmailV() == false) {

                document.getElementById("msgE").innerHTML;

            }

            if (
                nameV() == true &&
                PrenomV() == true &&
                EmailV() == true &&
                validate() == false) {
                document.getElementById("msg").innerHTML;
            }
            if (
                nameV() == true &&
                PrenomV() == true &&
                EmailV() == true &&
                validate() == true &&
                validateConfirm() == false) {
                document.getElementById("msgC").innerHTML;
            }
            if (
                nameV() == true &&
                PrenomV() == true &&
                EmailV() == true &&
                validate() == true &&
                validateConfirm() == true &&
                PhoneV() == false) {
                    document.getElementById("msgP").innerHTML;
                    }


            return false;
        }

    }
  
</script>

</html>
