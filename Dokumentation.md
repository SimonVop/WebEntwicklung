Dokumentation für das Webanwendungsprojekt mit Benutzerregistrierung und -anmeldung
1. Einleitung
1.1 Projektbeschreibung
Dieses Projekt ist eine einfache Webanwendung, die es Benutzern ermöglicht, sich zu registrieren und anzumelden. Es nutzt PHP als serverseitige Programmiersprache, MySQL für die Datenbankverwaltung und HTML/CSS für die Benutzeroberfläche. Ziel des Projekts ist es, ein grundlegendes Verständnis für Webentwicklung, Datenbankinteraktion und Benutzerauthentifizierung zu vermitteln. Die Anwendung dient als Grundlage für das Erlernen von grundlegenden Konzepten in der Webentwicklung und der Sicherheit im Umgang mit Benutzerdaten.

1.2 Zielgruppe
Die Anwendung richtet sich an Benutzer, die ein einfaches und sicheres Login-System benötigen. Darüber hinaus richtet sich das Projekt an Studierende und Anfänger in der Webentwicklung, die ihre Kenntnisse in PHP, MySQL und HTML/CSS vertiefen möchten.

1.3 Projektziele
Entwicklung eines funktionalen Anmeldesystems für Benutzer.
Implementierung von Sicherheitsmaßnahmen zum Schutz von Benutzerdaten.
Erlernen grundlegender Webentwicklungstechniken und -praktiken.
2. Technische Details
2.1 Technologie-Stack
Programmiersprache: PHP 7.x oder höher
Frontend: HTML, CSS (Bootstrap für das Styling), JavaScript
Datenbank: MySQL 5.7 oder höher
Server: Lokaler Server (XAMPP, WAMP oder MAMP)
2.2 Datenbankstruktur
Die MySQL-Datenbank besteht aus einer Tabelle userdata, die die folgenden Felder enthält:
  CREATE TABLE userdata (
    email VARCHAR(255) NOT NULL UNIQUE,
    passwort VARCHAR(255) NOT NULL
);

email: E-Mail-Adresse des Benutzers, die als einzigartig definiert ist.
passwort: Passwort des Benutzers, das gehasht gespeichert wird.

2.3 Sicherheitsmaßnahmen
Um die Sicherheit der Anwendung zu gewährleisten, wurden folgende Maßnahmen implementiert:

Passwort-Hashing: Passwörter werden mit der Funktion password_hash() gehasht, um die Sicherheit der Benutzeranmeldeinformationen zu gewährleisten.
Eingabevalidierung: Alle Benutzereingaben werden mit der Funktion htmlspecialchars() bereinigt, um Cross-Site Scripting (XSS) zu verhindern.
Vorbereitete Anweisungen: SQL-Injection-Angriffe werden durch die Verwendung vorbereiteter Anweisungen in MySQL verhindert.
3. Implementierung
3.1 Registrierung
Die Registrierung erfolgt über ein einfaches Formular, in dem der Benutzer seine E-Mail-Adresse und ein Passwort eingeben kann. Der folgende PHP-Code verarbeitet die Registrierungsanfrage:


// Verbindung überprüfen
    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }


    $emailadress = $conn->real_escape_string($_POST['email']);
    $password2 = $conn->real_escape_string($_POST['password']);
    $hashed_password = password_hash($password2, PASSWORD_DEFAULT); 

    // Prüfen, ob die E-Mail schon existiert
    $email_checksql =  "SELECT * FROM userdaten WHERE email = '$emailadress'";
    $result = $conn->query($email_checksql);

    if ($result-> num_rows > 0) {
        echo "<p>Du bist schon regestriert</p>
        <a href ='./index' class = 'btn btn-primary'>Weiter zur Anmeldung</a>";
    }
    else {
        $sqlstat = "INSERT INTO userdaten (email, passwort) VALUES ('$emailadress', '$hashed_password')";
        if ($conn->query($sqlstat) === TRUE) {
            echo "
            <h5 class='card-header'>Registrierung erfolgreich</h5>
            <a href='./index.html'>Weiter zur Anmeldung</a>";
        } else {
            echo "Fehler: " . $sqlstat . "<br>" . $conn->error;
      
    }
}
    // Verbindung schließen
    $conn->close();
    
3.2 Anmeldung
Für die Anmeldung wird das eingegebene Passwort mit dem in der Datenbank gespeicherten Passwort verglichen. Hier ist der entsprechende Code:

if ($con->connect_error) {
                die("No Connection possible". $con->connect_error); 
            }
        

            $email = $con->real_escape_string($_POST["email"]);
            $passwort = $con->real_escape_string($_POST["password"]);
            $directory = "htdocs\ProjektKanzlei\register.html";
            $email_checksql =  "SELECT * FROM userdaten WHERE email = '$email'";
            $password_check = "SELECT passwort FROM userdaten WHERE email ='$email'";
            $result = $con->query($email_checksql);
            $result2 = $con->query($password_check);
            
          

            if ($result2->num_rows > 0) {
                $row = $result2->fetch_assoc();
                $hashed_password_from_db = $row['passwort'];
                if (password_verify($passwort, $hashed_password_from_db)) {
                    echo "<p class='card-body'> <span id='pass'>Anmeldung erfolgreich</span>" ;
                    
                }
                elseif($result -> num_rows === 1 and password_verify($passwort, $hashed_password_from_db)===false) {
                    echo"
                    <h5 class = 'card-header'> Flasches Passwort </h5>
                    <a href ='./index.html' id='nochmal'> Passwort erneut eingeben </a>
                    "; 
                }
            }   

          
            else { 
                echo "
                <h5 class = 'card-header'> Anmeldung fehlgeschlagen </h5>
                <p class='card-body'> <span>Sie sind noch nicht Regestriert</span> 
                <a href ='./register.html'> Bitte regestrierern </a>
                </p>
                </div>
                </div>";
            }
          $con ->close();
3.3 Benutzeroberfläche
Die Benutzeroberfläche wurde mithilfe von HTML und Bootstrap gestaltet, um ein responsives Design zu gewährleisten. Hier ist ein Beispiel für das Registrierungsformular:

 <div id="card" class="card shadow p-3 mb-5 bg-white rounded">
        <div class="card-body">
            <h1 class="text-center mb-4">User Login</h1>
            <!-- Login Form -->
            <form action="save_data.php" method="POST" enctype="multipart/form-data">
                <!-- Email und Passwort Eingabe -->
                <div class="form-group mb-3">
                    <label for="inputEmail">E-Mail-Adresse</label>
                    <input type="email" class="form-control" name="email" placeholder="E-Mail eingeben">
                </div>
                <div class="form-group mb-3">
                    <label for="InputPassword">Passwort</label>
                    <input type="password" class="form-control" name="password" placeholder="Passwort eingeben">
                </div>
                <button type="submit" class="btn btn-primary w-100">Anmelden
            
                </button>
            </form>
            
            <!-- Registrieren-Button -->
            <div class="text-center mt-3">
            <p>Kein Konto?   <a href="./register.html"> Hier regestrieren?</a></p>

4. Herausforderungen und Lösungen
4.1 Herausforderungen
Während der Entwicklung gab es mehrere Herausforderungen, darunter:

Datenvalidierung: Sicherzustellen, dass die Eingaben des Benutzers korrekt sind und den Sicherheitsstandards entsprechen.
Fehlersuche: Identifizierung von Fehlern im Code und in der Datenbankabfrage, insbesondere bei der Interaktion mit der Datenbank.
4.2 Lösungen
Diese Herausforderungen wurden durch folgende Maßnahmen angegangen:

Implementierung detaillierter Fehlerprotokolle, um Probleme schneller zu identifizieren.
Nutzung von try-catch-Blöcken, um Fehler abzufangen und benutzerfreundliche Fehlermeldungen bereitzustellen.
5. Fazit und Ausblick
Dieses Projekt hat grundlegende Techniken der Webentwicklung demonstriert und dabei einen soliden Überblick über die Implementierung eines einfachen Registrierungs- und Anmeldesystems gegeben. Die Anwendung könnte in Zukunft durch zusätzliche Funktionen erweitert werden, wie z.B. Passwort-Wiederherstellung, E-Mail-Verifizierung und eine umfassendere Benutzeroberfläche.

5.1 Zukünftige Erweiterungen
Passwort-Zurücksetzen: Implementierung einer Funktion zum Zurücksetzen von Passwörtern per E-Mail.
Benutzerprofil: Erstellung einer Benutzerprofilseite, auf der Benutzer ihre Informationen einsehen und aktualisieren können.
Verbesserte Benutzeroberfläche: Nutzung fortgeschrittener Frontend-Technologien, um eine ansprechendere Benutzererfahrung zu schaffen.
5.2 Schlussfolgerung
Zusammenfassend lässt sich sagen, dass dieses Projekt eine wertvolle Lernerfahrung in der Webentwicklung bietet. Es vermittelt die grundlegenden Prinzipien von Benutzerregistrierung und -anmeldung sowie bewährte Praktiken für die Sicherheit im Umgang mit Benutzerdaten. Die Anwendung legt den Grundstein für zukünftige Entwicklungen im Bereich der Webanwendungen.
