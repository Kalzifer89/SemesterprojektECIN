<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester  //
// Beschreibung : header                     //
// Ersteller    : Sven Krumbeck              //
// Stand        : 22.05.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

//Menü der Seite in HTML
echo "Svens Quiz";
echo "      <div id=\"headermenu\">\n";
echo "        <form action=\"index.php\" method=\"POST\">";
echo "        <button name=\"nextQuestion\" value=\"nextQuestiont\" type=\"submit\">Quiz</button>";
echo "        <button name=\"stats\" value=\"stats\" type=\"submit\">Statistik</button>";
echo "        <button name=\"help\" value=\"help\" type=\"submit\">Hilfe</button>";
echo "        <button name=\"admin\" value=\"admin\" type=\"submit\">Admin</button>";
echo "        </form>";
echo "      </div>\n";
//Benutzer Login Bereich im Header
echo "      <div id=\"loginarea\">\n";

//Wenn nicht Eingelogt, bitte Einloggen Anzeigen
if (isset ($_COOKIE['LoggedIn'])) {
  if ($_COOKIE['LoggedIn'] == "True") {
    echo $_COOKIE['UserName'];
    echo "<form action=\"index.php\" method=\"POST\">";
      echo "<button name=\"ausloggen\" value=\"ausgelogt\" type=\"submit\">Ausloggen</button>";
    echo "</form>";
  }
}
else {
  echo "Sie sind nicht eingelogt";
}
echo "      </div>\n";

?>
