<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Content                     //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

if (isset($_COOKIE['LoggedIn'])) {
  if ($_COOKIE['LoggedIn'] == true && $_COOKIE['isAdmin'] == 1)
  {

    //Den Statistik Bereich Anzeigen wenn eingelogt und der Statisk Button gedrückt wird
    if (isset($_POST['stats'])) {
        include './core/stats.php';

    }

    //Bei Drucken auf den Admin Knopf auf die Admin Seite wechseln
    elseif (isset($_POST['admin'])) {
          echo "<meta http-equiv=\"refresh\" content=\"1; URL=admin.php\">";
    }

    //Bei Drucken auf den Registerungsbutton den Registrierungsdialog anzeigen
    elseif (isset($_POST['register'])) {
        captcha ();
        registerArea();
    }

    //Anzeigen des Quizes wenn der User eingelogt ist.
    elseif (isset($_COOKIE['LoggedIn'])) {
      if ($_COOKIE['LoggedIn'] == "True") {
        include './core/quiz.php';
      }
    }

  }
}
    //Ansonsten den Login Bereich und den Registrerungsbutton anzeigen
    else {
      captcha ();
      loginArea();
      registerButtion ();

    }
?>
