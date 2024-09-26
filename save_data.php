<!DOCTYPE html>
<html lang ="de">
<head>
    <title> User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        h5{
            display: flex;
            justify-content: center;
            margin-bottom: 160px;
        
        .pass{
            font-size: 3rem;
        }    

        }
        span {
            font-size: 1.2rem;
            display: flex;
            justify-content: center;
        }

        a{
            display: flex;
            justify-content: center;
            font-size: 1.5rem;
        }   

      


        #card {
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div id ="card" class ="card shadow p-3 mb-5 bg-white rounded">
        <div class = "container">
        <?php
            $servername="localhost";
            $username="root";
            $password ="";
            $dbname= "web";
            $table_name= "userdata";

            $con = new mysqli($servername, $username, $password, $dbname, );

            if ($con->connect_error) {
                die("No Connection possible". $con->connect_error); 
            }
        

            $email = $_POST["email"];
            $passwort = $_POST["password"];
            $directory = "htdocs\ProjektKanzlei\register.html";
            $email_checksql =  "SELECT * FROM userdaten WHERE email = '$email'";
            $password_check = "SELECT * FROM userdaten WHERE passwort='$passwort' and email ='$email'";
            $result = $con->query($email_checksql);
            $result2 = $con->query($password_check);
          

            if ($result2 -> num_rows === 1) {
                echo "<p class='card-body'> <span id='pass'>Anmeldung erfolgreich</span>" ;
              
            }
            elseif($result -> num_rows === 1 and $result2 -> num_rows < 1){
                echo"
                <h5 class = 'card-header'> Flasches Passwort </h5>
                <a href ='./index.html' id='nochmal'> Passwort erneut eingeben </a>
                "; 
            }

            else{
                echo "
                <h5 class = 'card-header'> Anmeldung fehlgeschlagen </h5>
                <p class='card-body'> <span>Sie sind noch nicht Regestriert</span> 
                <a href ='./register.html'> Bitte regestrierern </a>
                </p>
                </div>
                </div>";
            }

        ?>
        </div>
</div>
</body>
</html>