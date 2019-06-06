<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                    //
// Fachbereich Medien FH-Kiel - 4. Semester  //
// Beschreibung : Sidebar                    //
// Ersteller    : Sven Krumbeck              //
// Stand        : 27.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Auswahl der Kategorie in Coockie speichern
if(isset($_POST['category']))
      {
          setcookie("category", $_POST['category'], 0);
          echo "<meta http-equiv=\"refresh\" content=\"1; URL=index.php\">";
      }

//Datenbank Abfrage nach Kategorien
$DatenbankAbfrageKategorien= "SELECT categoryName, categoryID FROM categorys";
$KategorieArray = mysqli_query ($db_link, $DatenbankAbfrageKategorien);

echo "<h3>Kategorien</h3>\n";
echo "<hr>";
echo "<form class=\"category\" action=\"index.php\" method=\"post\">\n";
echo "<button type=\"submnit\" name=\"category\" value=\"alle\"class=\"all\">alle</button> <br>  \n";
// Wenn mehr als 0 Tupel vorhanden sind -------------------------------
    if (mysqli_num_rows ($KategorieArray) > 0)
        {
// aktuelles Tupel ausgeben --------------------------------------------------
            while ($zeile = mysqli_fetch_array($KategorieArray))
             {
               echo "<button type=\"submnit\" name=\"category\" value=\"".$zeile['categoryID']."\">".$zeile['categoryName']."</button> <br>  \n";
             }
        }
echo "</form>";
echo "<hr>";
schwerikeitsgradkurz();



?>
