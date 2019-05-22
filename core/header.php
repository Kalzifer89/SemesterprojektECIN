<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester  //
// Beschreibung : header                     //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Default Wert für Eingelogt festlegen (Nicht eingelogt)
if(!isset($_SESSION['eingelogt']))
  {
    // Standard - Einstellung --------------------------
    $_SESSION['eingelogt'] = false;
  }



echo "      <div id=\"headermenu\">\n";
echo "        Svens Quiz\n";
echo "        <a href=\"url\">Üben</a>\n";
echo "        <a href=\"url\">Übungen Verwalten</a>\n";
echo "        <a href=\"url\">Statistik</a>\n";
echo "        <a href=\"url\">Administrator</a>\n";
echo "      </div>\n";
echo "      <div id=\"loginarea\">\n";
echo "        sven.krumbeck@gmail.com  <a href=\"url\">LOGOUT</a>\n";
echo "      </div>\n";

?>
