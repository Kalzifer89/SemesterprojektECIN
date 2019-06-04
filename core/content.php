<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Content                     //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Den Statistik Bereich Anzeigen wenn eingelogt und der Statisk Button gedrückt wird
if (isset($_POST['stats'])) {
  if ($_COOKIE['LoggedIn'] == "True") {
    include './core/stats.php';
  }
}

//Anzeigen des Quizes wenn der User eingelogt ist.
elseif (isset($_COOKIE['LoggedIn'])) {
  if ($_COOKIE['LoggedIn'] == "True") {
    include './core/quiz.php';
  }
}

//Bei Drucken auf den Registerungsbutton den Registrierungsdialog anzeigen
elseif (isset($_POST['register'])) {
    captcha ();
    registerArea();
}

//Ansonsten den Login Bereich und den Registrerungsbutton anzeigen
else {
  captcha ();
  loginArea();
  registerButtion ();

}

?>
