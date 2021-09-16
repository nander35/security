<?php
//Als loginformulier reeds werd verzonden
if($_SERVER["REQUEST_METHOD"] == "POST"){
    login($_POST["username"], $_POST["password"]);
}

if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}

function login($username, $password){
    //Maak verbinding met database
    $host = '127.0.0.1';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'security_db';
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}


    //Vraag resultaat
    $sql = 'SELECT * FROM users WHERE username = "'.$username .'" AND password ="'.$password.'";';
    $result = $conn->query($sql);

    //Sluit verbinding met database
    $conn->close();

    //Onderneem actie op basis van resultaat
    if ($result->num_rows == 0) {
        echo "<script>alert('Incorrecte gegevens!');</script>";
    } else {
        echo "<script>alert('Succes!');</script>";
    }
}
?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!--Externe stylesheets-->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/4.1/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form action="login.php" method="post" class="form-signin">
    <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    <input  type="submit" class="btn btn-lg btn-primary btn-block" value="Login">
</form>
</body>
</html>