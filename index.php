<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester  //
// Beschreibung : Hauotseite                 //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

error_reporting(E_ALL);

session_start();

//Einbinden der Funktionen
include './core/functions.php';
//Einbinden der Config Dateien
include './config/config.php';
//Einbinden der Login Mechanik
include './core/sessioncontroller.php';

echo "<head>\n";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"./css/style.css\">\n";
echo "<meta charset=\"UTF-8\">\n";
echo "<title>Svens Quiz</title>";
echo "</head>\n";
echo "<div id=\"wrapper\">\n";
echo "    <header>\n";
          //Einbinden des Headers
          include './core/header.php';
echo "    </header>\n";
echo "    <div id=\"mehrspaltig\">\n";
echo "        <nav>\n";
              //Einbinden der Sitebar
              include './core/sidebar.php';
echo "        </nav>\n";
echo "        <article>";
              //Einbinden des Content Bereiches
              include './core/content.php';
echo "        </article>\n";
echo "        <aside>";
              include './core/sidebar2.php';
echo "        </aside>\n";
echo "    </div>\n";
echo "    <footer>\n";
          //Einbinden des Footers
          include './core/footer.php';
echo "    </footer>\n";
echo "</div>";

?>
