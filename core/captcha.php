<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Einstellungen               //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

// CAPTCHA-Funktion
function anzeige()
{
  // zwei zufällige Zahlen ermitteln -------
  $_SESSION['wert1'] = rand(0,100);
  $_SESSION['wert2'] = rand(0,100);
  // Berechnung des Ergebnisses ------------
  $_SESSION['ergebnis'] = $_SESSION['wert1']
  + $_SESSION['wert2'];
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
$_SESSION['name'] = $_POST['name'];
// Fehlermöglichkeit 1 ---------------------
if( empty ($_POST['name']) && empty($_POST['captcha']))
    {
    $_SESSION['fehler'] =
    "Name und Berechnungsergebnis müssen eingegeben werden!";
    // erneuter Funktionsaufruf -----------
    anzeige();
}

// Fehlermöglichkeit 2 ---------------------
if(!empty ($_POST['name']) && empty($_POST['captcha']))
{
  $_SESSION['fehler'] =
  "Berechnungsergebnis muss eingegeben werden!";
  // erneuter Funktionsaufruf ------------
  anzeige();
}

// Fehlermöglichkeit 3 ---------------------
if( empty ($_POST['name']) && !empty($_POST['captcha']))
{
  $_SESSION['fehler'] =
  "Name muss eingegeben werden!";
  // erneuter Funktionsaufruf ------------
  anzeige();
}

// Fehlermöglichkeit 4 ---------------------
if( !empty ($_POST['name']) && !empty($_POST['captcha']))
{
  if( $_POST['captcha'] !=$_SESSION['ergebnis'])
    {
    $_SESSION['fehler'] =
    "Berechnungsergebnis ist falsch!";
    // erneuter Funktionsaufruf --------
    anzeige();
    }
  else
  {
Verarbeitung
}

?>
