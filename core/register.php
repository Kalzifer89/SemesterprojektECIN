<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester  //
// Beschreibung : Registrierung              //
// Ersteller    : Sven Krumbeck              //
// Stand        : 23.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Bei Erfolgreichen Login Login Cookie Erstellen ansonsten Fehlermeldung
//Überprüfung ob Name und Passwort ausgefüllt sind
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
    $RegisterFehlermeldung ="Sie sind erfolgreich eingelogt";
    //Eingelogt setzen
    setcookie("LoggedIn", "True", 0);
    setcookie("UserName", "$Username",0);
    echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
  }

?>
