<!DOCTYPE html>
<html lang ="de">
<head>
    <title> User Regstrierung</title>
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
                font-size: 1.3rem;
                margin-bottom: 160px;
                
            }
       

            a{
                display: flex;
                justify-content: center;
                font-size: 1rem;
            }
            .nochmal{
            display: flex;
            justify-content: center;
            font-size: 0.5rem;
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
    // Mit der Datenbank verbinden
        $servername="localhost";
        $username="root";
        $password ="";
        $dbname= "web";
        $conn = new mysqli("localhost", "root", "", "web",);

    // Verbindung überprüfen
    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }



    $emailadress = $_POST['email'];
    $password2 = $_POST['password'];

    // Prüfen, ob die E-Mail schon existiert
    $email_checksql =  "SELECT * FROM userdaten WHERE email = '$emailadress'";
    $idcounter ="SELECT MAX(ID) FROM userdata";
    $result = $conn->query($email_checksql);

    if ($result-> num_rows > 0) {
        echo "<p>Du bist schon regestriert</p>
        <a href ='./index' class = 'btn btn-primary'>Weiter zur Anmeldung</a>
       
    ";
    }else {
        $sqlstat = "INSERT INTO userdaten (email, passwort) VALUES ('$emailadress', '$password2')";
        echo "
        <h5 class = 'card-header'> Regestrierung erfolgreich </h5>
        <a href ='./index.html'> Weiter zur Anmeldung </a>
        </p>
        </div>
        </div>";
      
    }
 
    // Verbindung schließen
    $conn->close();
    ?>
</body>
</html>
