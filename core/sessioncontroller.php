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

if (isset($_POST['name'])) {
  //Datenbank Abfrage nach Benutzername
  $DatenbankAbfrageUser = "SELECT userName FROM users WHERE userName LIKE '$_POST['name']';";
  $UserArray = mysqli_query ($db_link, $DatenbankAbfrageUser);
  //Datenbank Abfrage nach Passwort
  $DatenbankAbfragePasswort = "SELECT passwort FROM users WHERE passwort LIKE '$Passwort';";
  $PasswortArray = mysqli_query ($db_link, $DatenbankAbfragePasswort);
}

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
  else {
    $Fehlermeldung ="Sie sind erfolgreich eingelogt";
    //Eingelogt setzen
    setcookie("LoggedIn", "True", 0);
    echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
  }

?>
