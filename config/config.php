<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Einstellungen               //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Datenbankzugriff
$host="localhost"; //Hostname
$user="root"; //Benutzername
$pass=""; //Passwort
$dbase="ecinquiz"; //Datenbankname

$db_link = mysqli_connect($host, $user, $pass);
//Charakter Encoonding richtig setzen
$db_link->set_charset("utf8");
mysqli_select_db($db_link, $dbase);

//Einstellungen für das quiz
//Anzahl der Punkte für Einfache Fragen
$ScoreEasy = 1;
//Anzahl der Punkte für Mittlere Frahen
$ScoreMiddle = 2;
//Anzahl der Punkte für Harte Fragen
$ScoreHard = 3;
?>
