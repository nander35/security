<?php
//Als loginformulier reeds werd verzonden
if($_SERVER["REQUEST_METHOD"] == "POST"){
    register($_POST["username"], $_POST["password"], $_POST["profielfoto"]);
}

function register($username, $password, $profielfoto){
    //Maak verbinding met database
    $host = '127.0.0.1';
    $dbuser = 'root';
    $dbpass = '';
    $dbname = 'security_db';
    $conn = new mysqli($host, $dbuser, $dbpass, $dbname);
    if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}


    //Vraag resultaat
    $query = "INSERT INTO users (username, password, profielfoto) VALUES('$username', '$password', '$profielfoto')";
    $register = $conn->query($query);

    //Sluit verbinding met database
    $conn->close();

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
<form action="register.php" method="post" class="form-signin">
    <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    <input type="file" id="inputPicture" name="profielfoto" class="form-control" required>
    <input  type="submit" class="btn btn-lg btn-primary btn-block" value="Login">
</form>
<script>
 
function isValidHttpUrl(string) {
  let url;
  
  try {
    url = new URL(string);
  } catch (_) {
    return false;  
  }

  return url.protocol === "http:" || url.protocol === "https:";
}


</script>
</body>
</html>