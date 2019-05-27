<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Content                     //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Anzeigen des Einlog Formular wenn der LoginCoockie auf False steht
if (isset($_COOKIE['LoggedIn'])) {
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
