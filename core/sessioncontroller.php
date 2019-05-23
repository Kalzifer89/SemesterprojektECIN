<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester  //
// Beschreibung : Controller für Login       //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Bei Klick auf Logout Buttion den Login Coockie Löschen
if( isset($_POST['ausloggen']))
      {
          setcookie("LoggedIn", "false", 0);
          echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
      }

//Wenn das Anmelde Formular Ausgefüllt wurde, die Datenbank Abfrage anstoßen
if (isset($_POST['name'])) {
  //Umwandeln in Variablen für Mysql und Passwort Verschlüsselung
  $Username = $_POST['name'];
  $Passwort = md5($_POST['passwort']);
  //Datenbank Abfrage nach Benutzername
  $DatenbankAbfrageUser = "SELECT userName FROM users WHERE userName LIKE '$Username'";
  $UserArray = mysqli_query ($db_link, $DatenbankAbfrageUser);
  //Datenbank Abfrage nach Passwort
  $DatenbankAbfragePasswort = "SELECT UserPassword FROM users WHERE UserPassword LIKE '$Passwort';";
  $PasswortArray = mysqli_query ($db_link, $DatenbankAbfragePasswort);
}

// Vorbelegung der SESSION-Variablen -------
// Erstaufruf des Programms ----------------
// Aufruf der CAPTCHA-Funktion -------------
if(!isset($_POST['wahl']))
{
  $_SESSION['fehler'] = "";
  $_SESSION['name'] = "";
  $_SESSION['captcha'] = "";
  anzeige();
}

// Zuweisungen nach submit -----------------
if(isset($_POST['name']))
{$_SESSION['name'] = $_POST['name'];}



//Bei Erfolgreichen Login Login Cookie Erstellen ansonsten Fehlermeldung
//Überprüfung ob Name und Passwort ausgefüllt sind
if(empty ($_POST['name']) && empty ($_POST['passwort']))
  {
    $Fehlermeldung ="Namen und Passwort fehlen";
  }
  //Überprüfung ob Name Ausgefüllt ist
  elseif (empty ($_POST['name'])) {
    $Fehlermeldung ="Namen fehlt";
  }
  //ÜBerprüfung ob Passwort ausgefüllt ist
  elseif (empty ($_POST['passwort'])) {
    $Fehlermeldung ="Passwort fehlt";
  }
  elseif (mysqli_num_rows ($UserArray) == 0) {
    $Fehlermeldung ="Benutzername nicht in Datenbank";
  }
  elseif (mysqli_num_rows ($PasswortArray) == 0) {
    $Fehlermeldung ="Passwort nicht in Datenbank";
  }
  elseif (empty($_POST['captcha'])) {
    $Fehlermeldung ="Das Ergebniss muss eingeben werden";
  }
  elseif (!empty($_POST['captcha'])) {
    if( $_POST['captcha'] !=$_SESSION['ergebnis']) {
      $Fehlermeldung ="Ergebniss ist Falsch";
    }
  }
  else {
    $Fehlermeldung ="Sie sind erfolgreich eingelogt";
    //Eingelogt setzen
    setcookie("LoggedIn", "True", 0);
    setcookie("UserName", "$Username",0);
    echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
  }

?>
