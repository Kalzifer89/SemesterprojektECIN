-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Jun 2019 um 18:16
-- Server-Version: 10.1.38-MariaDB
-- PHP-Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ecinquiz`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categorys`
--

CREATE TABLE `categorys` (
  `categoryID` int(10) NOT NULL,
  `categoryName` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `categorys`
--

INSERT INTO `categorys` (`categoryID`, `categoryName`) VALUES
(1, 'Geografie'),
(3, 'Geschichte'),
(4, 'Naturwissenschaften'),
(5, 'Sport'),
(6, 'Mathe'),
(7, 'Chemie');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `questions`
--

CREATE TABLE `questions` (
  `questionID` int(10) NOT NULL,
  `questionCategory` int(10) NOT NULL,
  `questionContent` text COLLATE utf8_bin NOT NULL,
  `questionAnswer1` varchar(50) COLLATE utf8_bin NOT NULL,
  `questionAnswer2` varchar(50) COLLATE utf8_bin NOT NULL,
  `questionAnswer3` varchar(50) COLLATE utf8_bin NOT NULL,
  `questionAnswer4` varchar(50) COLLATE utf8_bin NOT NULL,
  `questionAnswerRight` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `questions`
--

INSERT INTO `questions` (`questionID`, `questionCategory`, `questionContent`, `questionAnswer1`, `questionAnswer2`, `questionAnswer3`, `questionAnswer4`, `questionAnswerRight`) VALUES
(2, 1, 'Wie heißt der längste Fluss innerhalb Deutschlands?', 'Elbe  ', 'Weser', 'Donau', 'Rhein', 'Rhein'),
(3, 3, 'Wie wird ein Partisanenkämpfer des vorindustriellen Japans bezeichnet?', 'Samurai  ', 'Ninja', 'Sumo', 'Chief', 'Ninja'),
(4, 4, 'Das ist ein test', 'Hier ', 'wird', 'noch', 'geändert', 'Ninja'),
(5, 3, 'Wer wurde 1981 US-Ehrenbürger, obwohl er wahrscheinlich tot war?', 'Gandhi', 'Raoul Wallenberg', 'Oskar Schindler', 'Henri Dunant', 'Raoul Wallenberg'),
(6, 3, 'Wie wird ein Partisanenkämpfer des vorindustriellen Japans bezeichnet?', 'Seaman', 'Ninja', 'Sumo', 'Chief', 'Ninja'),
(8, 3, 'Wie viele Weltwunder gab es?', 'Fünf', 'Neun', 'Sieben', 'Sechs', 'Sieben'),
(9, 0, 'Als was wurde der um 1525 geborene Stubbe-Peter bekannt?', 'Werwolf von Bedburg', 'Prinz von Homburg', 'Jäger von Soest', 'Rattenfänger von Hameln', 'Werwolf von Bedburg'),
(10, 3, 'Wie heißt ein wichtiges Adelsverzeichnis?', 'Almanach de Schmalkalden', 'Almanach de Gotha', 'Almanach d\'Erfurt', 'Almanach d\'Anstedt', 'Almanach de Gotha'),
(11, 3, 'Welchen Beinamen hatte Kaiser Maximilian I.?', 'Der Bürgerkönig', 'Der große Kurfürst', 'Der Stammler', 'Der letzte Ritter', 'Der letzte Ritter'),
(12, 3, 'Welche Stadt des damaligen schwedischen Reichs wurde 1656 erfolglos von russischen Truppen belagert?', 'Stockholm', 'Turku', 'Reval', 'Riga', 'Riga'),
(13, 3, 'Welche Stadt war in der Antike das Zentrum des Nabatäerreiches?', 'Smyrna', 'Ephesos', 'Petra', 'Plamyra', 'Petra'),
(14, 3, 'Wo stand Slobodan Milosevi? vor Gericht?', 'Straßburg', 'Den Haag', 'Paris', 'Lyon', 'Den Haag'),
(15, 1, 'Was ist kein deutsches Mittelgebirge?', 'Schwarzwald', 'Grunwald', 'Thüringer Wald', 'Bayrischerwald', 'Schwarzwald'),
(16, 1, 'Welche beiden Länder liegen am Golf von Biskaya?', 'Italien und Frankreich', 'Frankreich und Spanien', 'Italien und Portugal', 'Portugal und Spanien', 'Frankreich und Spanien'),
(17, 1, 'Wo findet man das Schloss Sanssouci?', 'Braunschweig', 'Potsdam', 'Hannover', 'Berlin', 'Potsdam'),
(18, 1, 'Welches ist die kleinste Landeshauptstadt Deutschlands?', 'Erfurth', 'Schwerin', 'Potsdam', 'München', 'Schwerin'),
(19, 1, 'Welcher See liegt nicht in Bayern?', 'Chiemsee', 'Starnberger See', 'Schweriner See', 'Ammersee', 'Schweriner See'),
(20, 1, 'Welche ist die östlichste Stadt Deutschlands?', 'Bautzen', 'Dresden', 'Zittau', 'Görlitz', 'Görlitz'),
(21, 1, 'Welche Stadt hat den größten Hafen?', 'Wilhelshaven', 'Rostock', 'Hamburg', 'Bremerhaven', 'Hamburg'),
(22, 1, 'Durch welchen Industriezweig ist Wolfsburg bekannt?', 'Automobil Industrie', 'Chemische Industrie', 'Textilindustrie', 'Bergbau', 'Automobil Industrie'),
(23, 1, 'In den Börden herrscht welche Bodenart vor?', 'Lössboden', 'Sandboden', 'Lehmböden', 'Tonböden', 'Lössboden'),
(24, 1, 'Welcher Erdschatz führte zur Entstehung des Ballungsraumes „Ruhrgebiet“?', 'Eisenerz', 'Zinn', 'Kohle', 'Silber', 'Kohle'),
(25, 1, 'Welche Stadt hat die meisten Einwohner?', 'Berlin', 'Köln', 'München', 'Hamburg', 'Berlin'),
(26, 1, 'Was versteht man unter „ Hallig“?', 'Einkaufszentrum', 'Einwohner von Halle', 'Kleine Insel ohne Deich', 'Einen Hafen', 'Kleine Insel ohne Deich'),
(32, 1, 'Wie hieß das Schiff des berühmten Piraten Blackbeard?', 'Reapers Top', 'Speaker House', 'Whydah First Bird', 'Queen Annes Revenge', 'Queen Annes Revenge'),
(33, 4, 'Wie viele Zähne hat das menschliche Milchgebiss?', '28', '20', '24', '32', '20'),
(34, 4, 'Durch welches Körperteil verläuft der Karpaltunnel?', 'Herz ', 'Fuß', 'Hand', 'Hals', 'Hand'),
(35, 4, 'Wie nennt man Ferkel, die bereits in der sechsten Lebenswoche geschlachtet und gegessen werden?', 'Spanferkel', 'Thronferkel', 'Lemusferkel', 'B-Ferkel', 'Spanferkel'),
(36, 4, 'Welches ist die grösste Maschine der Welt?', 'Internationale Raumstation ISS', 'Frachtflugzeug Antanov An-225', 'Bertha, die Tunnelbohrmaschine', 'Large Hadron Collider LHC', 'Large Hadron Collider LHC'),
(37, 4, 'Wie lange braucht das Licht der Sonne bis zur Erde?', '8 ½ Milli-Sekunden', '8 ½ Sekunden', '8 ½ Minuten', '8 ½ Stunden', '8 ½ Minuten'),
(38, 4, 'Wie schnell ist der Schall?', 'Rund 330 Meter pro Sekunde', 'Rund 550 Meter pro Sekunde', 'Rund 880 Meter pro Sekunde', 'Rund 1100 Meter pro Sekunde', 'Rund 330 Meter pro Sekunde'),
(39, 4, 'Wie viele Handys benötigt man, um ein Gramm Gold zu gewinnen?', '41', '139', '352', '508', '41'),
(40, 4, 'Wo liegt der absolute Nullpunkt?', '0 Grad', 'Minus 139,35 Grad', 'Minus 273,15 Grad', 'Minus 503,75 Grad', 'Minus 273,15 Grad'),
(41, 4, 'Welches Land ausser der Schweiz und Liechtenstein benützt ebenfalls den Steckertyp J?', 'Bhutan', 'El Salvador', 'Ruanda', 'Tadschikistan', 'Ruanda'),
(42, 4, 'In welcher Einheit wird die Beleuchtungsstärke gemessen?', 'In Candela', 'In Lux', 'In Luve', 'In Lumen', 'In Candela'),
(43, 4, 'Wie ist der Begriff «Arbeit» physikalisch definiert?', 'Leistung pro Zeit', 'Energie pro Masse', 'Impuls mal Volumen', 'Kraft mal Weg', 'Kraft mal Weg'),
(44, 4, 'Welche Vorsatzsilbe steht für 0,001?', 'Dezi', 'Zenti', 'Milli', 'Mikro', 'Milli'),
(45, 4, 'Hinter welchen der folgenden Namen verbirgt sich KEINE Programmiersprache?', 'Pascal', 'Linda', 'Jasmin', 'Marcus', 'Marcus'),
(46, 6, '2X – 8 = –X + 1', 'X = 3', 'X = 9', 'X = 12', 'X = -3', 'X = 3'),
(47, 6, '12 ÷ 2 (5 – 2) = x', '12', '2', '9', '18', '18'),
(48, 6, 'Wandle ¼ in Dezimalzahlen um.', '0,40', '0,25', '0,4', '0,20', '0,25'),
(49, 6, 'Rechne 120% in Dezimalzahlen um', '123,45% ', '1,2345%', '12.345%', '12345%', '12345%'),
(50, 6, '24 ÷ 4 (8 ÷ 4) = x', '12', '3', '8', '4', '12'),
(51, 6, '23 + 17x + 3 = 13x + 46 + 3x', 'x=23', 'x=-23', 'x=-20', 'x=20', 'x=20'),
(52, 5, 'Welches der folgenden Länder war noch nie Fußballweltmeister?', 'Frankreich', 'England', 'Uruguay', 'Niederlande', 'Niederlande'),
(53, 5, 'Warum musste der Meistertrainer Richard Dombi den FC Bayern München im Frühjahr 1933 verlassen?', 'Er war Kommunist', 'Er hatte im 1. Weltkrieg Fahnenflucht begangen', 'Er hatte ein Verhältnis mit der Präsidentengattin', 'Er war Jude', 'Er war Jude'),
(54, 5, 'In welchen Jahren finden die Olympischen Sommerspiele stets statt?', 'in Schaltjahren', 'in Sonnenjahren', 'in Mondjahren', 'in Heiligen Jahren', 'in Schaltjahren'),
(55, 5, 'Wo geschah ein Fußballwunder im Jahre 1954?', 'Bern', 'Frankfurt', 'Hamburg', 'Zürich', 'Bern'),
(56, 5, 'Wer war Oberbürgermeister in München während der Olympiade 1972?', 'Hans Jochen Vogel', 'Beatrice Knop', 'Heinrich Heine', 'Jörg Kuser', 'Hans Jochen Vogel'),
(57, 5, 'Welcher alpine Skirennläufer wurde von den Olympischen Winterspielen 1972 wegen Verletzung des Amateurstatus ausgeschlossen?', 'CHristian Neureuther', 'Karl Schranz', 'Heinrich Messner', 'Roland Collombin', 'Karl Schranz'),
(58, 5, 'Wer gewann den olympischen Eiskunstlauf der Damen in Vancouver mit neuem Weltrekord?', 'Kim Yu-Na, Südkorea', 'Mao Asada, Japan', 'Liu Yan, China', 'Mirai Nagasu, USA', 'Kim Yu-Na, Südkorea'),
(59, 5, 'Warum ist das Jahr 2016 für den Golfsport so wichtig?', 'der Golfsport wird 200 Jahre alt', 'die Löcher werden vergrößert', 'Golf wird wieder olympisch', 'die Unterscheidung zwischen Amateuren und Profis f', 'Golf wird wieder olympisch'),
(60, 5, 'Der bei TSG 1899 Hoffenheim spielende Kroate Josip Simunic wurde geboren in ...?', 'Canberra, Australien', 'Cardiff, Wales', 'Zagreb, Kroatien', 'Kapstadt, Südafrika', 'Canberra, Australien');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `score`
--

CREATE TABLE `score` (
  `scoreID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `questionsRight` int(10) NOT NULL DEFAULT '0',
  `questionsWrong` int(10) NOT NULL DEFAULT '0',
  `score` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `score`
--

INSERT INTO `score` (`scoreID`, `userID`, `questionsRight`, `questionsWrong`, `score`) VALUES
(1, 2, 136, 122, 268),
(2, 8, 15, 5, 30),
(3, 10, 1, 0, 2),
(4, 9, 10, 4, 20),
(5, 11, 4, 1, 8);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `userID` int(10) NOT NULL,
  `userName` varchar(50) COLLATE utf8_bin NOT NULL,
  `userMail` varchar(50) COLLATE utf8_bin NOT NULL,
  `userPassword` varchar(50) COLLATE utf8_bin NOT NULL,
  `userAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`userID`, `userName`, `userMail`, `userPassword`, `userAdmin`) VALUES
(2, 'Krumbeck', 'sven.krumbeck@gmail.com', '62cd275989e78ee56a81f0265a87562e', 1),
(8, 'Petra', 'petra@power.de', '62cd275989e78ee56a81f0265a87562e', 0),
(9, 'Peter', 'peter@panzer.de', '62cd275989e78ee56a81f0265a87562e', 0),
(11, 'Hans', 'hans@dieter.de', '62cd275989e78ee56a81f0265a87562e', 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indizes für die Tabelle `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionID`);

--
-- Indizes für die Tabelle `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`scoreID`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `categorys`
--
ALTER TABLE `categorys`
  MODIFY `categoryID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `questions`
--
ALTER TABLE `questions`
  MODIFY `questionID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT für Tabelle `score`
--
ALTER TABLE `score`
  MODIFY `scoreID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
