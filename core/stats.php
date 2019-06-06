<?php
///////////////////////////////////////////////
// Semesterproject - ECIN                     //
// Fachbereich Medien FH-Kiel - 4. Semester   //
// Beschreibung : Statistik                   //
// Ersteller    : Sven Krumbeck              //
// Stand        : 04.06.19                   //
// Version      : 1.0                        //
///////////////////////////////////////////////

echo "<h2>Statistiken</h2>";
echo"<hr>";
//Abfrage des Scores aus der Datenbank
$userID = $_COOKIE['UserID'];
$DatenbankAbfrageScore = "SELECT * FROM score WHERE userID LIKE '$userID'";
$ScoreArray = mysqli_query ($db_link, $DatenbankAbfrageScore);

// Wenn mehr als 0 Tupel vorhanden sind -------------------------------
    if (mysqli_num_rows ($ScoreArray) > 0)
        {
// aktuelles Tupel ausgeben --------------------------------------------------
            while ($zeile = mysqli_fetch_array($ScoreArray))
             {
               $questionsRight = $zeile['questionsRight'];
               $questionsWrong = $zeile['questionsWrong'];
               $score = $zeile['score'];
             }
           }

//Grundsätzliche Bild Eigenschaften
$bild = imagecreate(600, 400);
$hg = imagecolorallocate($bild,255,255,255);
$vg = imagecolorallocate ($bild,0,0,0);
$rot = imagecolorallocate ($bild,255,0,0);
$gruen = imagecolorallocate ($bild,0,255,0);
$blau = imagecolorallocate ($bild,0,0,255);
$weiß = imagecolorallocate ($bild,255,255,255);
imagefill($bild,0,0,$hg);
imagestring($bild,10,450,30,"Legende",$vg);
imagestring($bild,10,420,60,"Richtige Antworten",$vg);
imagestring($bild,10,420,90,"Falsche Antworten",$vg);
imagefilledrectangle ($bild , 400, 60 , 415 , 75 , $gruen );
imagefilledrectangle ($bild , 400, 90 , 415 , 105 , $rot );



//Prozentrechnung für ein Kreis Diagramm
//Berechnung Gesamtwert von 100%
$Gesamtwert = $questionsRight + $questionsWrong;
// 1% vom Kreis sind wieviele Grad
$grad_je_prozent = 360 / 100;

//Berechnung Prozent Kreisegement 1
$prozentwert1 = $questionsRight / $Gesamtwert * 100;
//Ende des ersten Kreisegements
$ende_kreissegment_1 = $grad_je_prozent *$prozentwert1;
//Zeichnen
imagefilledarc($bild, 200, 150,250, 250, 0,$ende_kreissegment_1 , $gruen, IMG_ARC_PIE);

// Kreissegment 2
//Berechnung Anfang
$anfang_kreissegment_2 = $grad_je_prozent * $prozentwert1;
//Berechnung Prozent Kreisegement 2
$prozentwert2 = $questionsWrong / $Gesamtwert * 100;
//Berechnung Ende
$ende_kreissegment_2 = $grad_je_prozent * ($prozentwert1 + $prozentwert2);
imagefilledarc($bild, 200, 150,250, 250, $anfang_kreissegment_2,$ende_kreissegment_2 , $rot, IMG_ARC_PIE);

//Ausgeben
imagepng($bild, "./img/statistikkreis.png");
echo "<img src=\"./img/statistikkreis.png\">";

//Beginn Highscore
//Abfrage der Score jeden User beginnend mit dem Höhsten Score
$DatenbankAbfrageHighScore = "SELECT * FROM users,score WHERE users.userID = score.userID ORDER BY `score`.`score` DESC";
$HighScoreArray = mysqli_query ($db_link, $DatenbankAbfrageHighScore);
$Platz = 0;

echo "<h2>Highscore<h2>";
echo "<table>\n";
echo "  <tr>\n";
echo "    <th>Platz</th>\n";
echo "    <th>Name</th>\n";
echo "    <th>Score</th>\n";
echo "  </tr>\n";
if (mysqli_num_rows ($ScoreArray) > 0)
    {
// aktuelles Tupel ausgeben --------------------------------------------------
        while ($zeile = mysqli_fetch_array($HighScoreArray))
         {
          $Platz = $Platz + 1;
          echo "  <tr>\n";
          echo "    <td>$Platz</td>\n";
          echo "    <td>".$zeile['userName']."</td>\n";
          echo "    <td>".$zeile['score']."</td>\n";
          echo "  </tr>\n";
        }
}
echo "</table>";



zurückbutton();
?>
