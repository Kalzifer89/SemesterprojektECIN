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
mysqli_select_db($db_link, $dbase);

?>
