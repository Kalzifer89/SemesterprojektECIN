<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester  //
// Beschreibung : Registrierung              //
// Ersteller    : Sven Krumbeck              //
// Stand        : 23.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Datenbankzugriff
$host="localhost"; //Hostname
$user="root"; //Benutzername
$pass=""; //Passwort
$dbase="ecinquiz"; //Datenbankname

$db_link = mysqli_connect($host, $user, $pass);
mysqli_select_db($db_link, $dbase);


if (isset($_POST['registername'])) {
  $registername = $_POST['registername'];
  $registermail = $_POST['registermail'];
  $registerpassword = md5($_POST['registerpassword']);
}

//Bei Erfolgreichen Login Login Cookie Erstellen ansonsten Fehlermeldung
//Überprüfung ob Name Passwort und EMail ausgefüllt sind
if(empty ($_POST['registername']) && empty ($_POST['registeremail']) && empty ($_POST['registerpassword']))
  {
    $RegisterFehlermeldung ="Namen Passwort und Email fehlen";
  }
  elseif(empty ($_POST['registername']) && empty ($_POST['registeremail'])){
      $RegisterFehlermeldung ="Namen und Password fehlen";
    }
  elseif(empty ($_POST['registerpassword']) && empty ($_POST['registeremail'])){
      $RegisterFehlermeldung ="Passwort und Mail fehlen";
    }
  elseif(empty ($_POST['registername']) && empty ($_POST['registerpassword'])){
      $RegisterFehlermeldung ="Namen und Password fehlen";
    }
  //Überprüfung ob Name Ausgefüllt ist
  elseif (empty ($_POST['registername'])) {
    $RegisterFehlermeldung ="Namen fehlt";
  }
  //ÜBerprüfung ob Passwort ausgefüllt ist
  elseif (empty ($_POST['registerpassword'])) {
    $RegisterFehlermeldung  ="Passwort fehlt";
  }
  elseif (empty($_POST['captcha'])) {
    $RegisterFehlermeldung  ="Das Ergebniss muss eingeben werden";
  }
  elseif($_POST['captcha'] !=$_SESSION['ergebnis']) {
    $RegisterFehlermeldung  ="Ergebniss ist Falsch";
    }
  else {
    $RegisterFehlermeldung ="Sie sind erfolgreich eingelogt, bitte melden sie sich jetzt an.";
    //Den neuen User in die Datenbank eintragen
    $DatenbankRegistierungUser = "INSERT INTO users (UserName, userMail, userPassword, userAdmin) VALUES ('$registername','$registermail','$registerpassword',0)";
    $UserArray = mysqli_query ($db_link, $DatenbankRegistierungUser);
    echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
  }

?>
