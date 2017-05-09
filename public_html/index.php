<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

$db = GetDB();

$db->GetAllRoomType();


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" lang="de">
    <title>Hotel Vallora | Wunderschönes Hotel</title>
    <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>
<body>
<header>
    <a href="#top"><h1>Hotel Vallora</h1></a>
    <nav>
        <ul>
            <li><a href="#main">Hotel</a></li>
            <li><a href="#room">Zimmer</a></li>
            <li><a href="#path">Wegbeschreibung</a></li>
            <li><a href="rooms.php">Buchen</a></li>
        </ul>
    </nav>
</header>

<div class="clear" id="top"></div>

<section id="image"><h1>Willkommen beim Hotel Vallora</h1></section>

<section class="main">
  <article id="main">
    <h1>Unser Hotel</h1>
    <p>Bei Ihrem nächsten Aufenthalt in unserer Gegend würden wir Sie gern persönlich begrüßen und mit unserem freundlichen und kompetenten Service verwöhnen.</p>
  </article>

    <article id="rooms">
      <h1>Zimmer</h1>
      <div class="gallery" id="gallery-guestrooms">
          <a href="#room"><img src="img/guestrooms/room1.jpg" alt="Unsere junior suite" /></a>
          <img src="img/guestrooms/room2.jpg" alt="" />
          <img src="img/guestrooms/room3.jpg" alt="" />
          <img src="img/guestrooms/room4.jpg" alt="Das Beste vom Besten, die delux suite mit Meer Blick." />
      </div>
      <div id="gallery-guestrooms">
        <?php
          foreach($db->GetAllRoomType() as $values){
            echo '<h1>' . htmlspecialchars($values['name']) . '</h1>';
            echo '<p>' . htmlspecialchars($values['description']) . '</p>';
            echo '<img src="' . $values['image'] . '">';
          }
        ?>
      </div>
    </article>
    <article id="path">
        <h1>Wegbeschreibung</h1>
        <p>Fahren Sie in Richtung Küste. Kurz vor dem Ortseingang von Küstendorf biegen Sie links in die Küstenallee ein. Nach der Kurve finden Sie  unser Hotel. Parkmöglichkeiten befinden sich direkt vor dem Hotel.</p>
    </article>
    <article id="events">
        <h1>Ausflüge</h1>

        <div class="gallery" id="gallery-events">
              <a href="#eventhistory"><img src="img/events/castle.jpg" alt="Römersiedlung" /></a>
            <a href="#eventhistory"><img src="img/events/ruine.jpg" alt="Ruine der Kirche Sankt Peter" /></a>
            <a href="#eventhistory"><img src="img/events/kloster.jpg" alt="Kloster Maria Hilf" /></a>
        </div>

        <p>Folgende Ausflüge können Sie an der Rezeption buchen.</p>
        <h4>1. Ballonglühen: </h4>
        <p>Beim Ballonglühen werden mehrere Heißluftballons am Boden verankert und nach Einbruch der Dunkelheit durch das Befeuern
            der balloneigenen Gasbrenner zum Glühen gebracht. Die bunten Farben kommen so besonders gut zur Geltung.Ein atemberaubendes Schauspiel für
            Jung und Alt.</p>

        <a class="anchor" id="eventhistory"></a>
        <h4>2. Historische Sehenswürdigkeiten der Umgebung</h4>
        <p>Bei diesem Ausflug fahren wir Sie zu folgenden interessanten Sehenswürdigkeiten der Region:</p>

        <ul>
            <li><p>Römersiedlung aus dem 2. Jh. n. Chr.</p></li>
            <li><p>Ruine der Kirche Sankt Peter aus dem 13. Jahrhundert</p></li>
            <li><p>Kloster Maria Hilf mit beeindruckendem gotischen Kreuzgang und gemütlicher Klosterschenke</p></li>
        </ul>

        <p>Die Eintrittspreise der Sehenswürdigkeiten sind im Preis des Ausfluges inbegriffen.</p>

        <h4>3. Bootsfahrt</h4>
        <p>Begleiten Sie uns auf eine sachkundig geführte Bootsfahrt durch das Naturschutzgebiet Krötenwiese.<br>
            Diese Bootsfahrt ist ein Erlebnis der besonderen Art:<br>
            In einem Fischerkahn können Sie bei einem Gläschen Wein die vielfältige Natur hautnah erleben.</p>
        <h4>4. 2-Tage-Ausflug zur Tour de France</h4>
        <p>Wir sind live beim größten Radrennen dabei. Die Anreise erfolgt am Nachmittag, und wir übernachten in
            einer netten Pension an der Route, um dann am darauffolgenden Tag ganz vorne mit dabei zu sein.</p>
        <table>
            <caption>Tagesablauf</caption>
            <thead>
            <tr>
                <th>Uhrzeit</th>
                <th>1. Tag</th>
                <th>2. Tag</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="centered">8:00-9:00</td>
                <td rowspan="2">Nichts</td>
                <td>Tagwach und Frühstück</td>
            </tr>
            <tr>
                <td class="centered">9:00-13:00</td>
                <td>Tour de France</td>
            </tr>
            <tr>
                <td class="centered">13:00-14:00</td>
                <td>Treffpunkt 13:00 und reise in die Pension</td>
                <td>Mittagessen bei nahegelegenen Lokal</td>
            </tr>
            <tr>
                <td class="centered">14:00-18:00</td>
                <td>Ankunft Pension und Überaschung</td>
                <td>Tour de France</td>
            </tr>
            <tr>
                <td class="centered">18:00-19:00</td>
                <td>Abendessen</td>
                <td>Rückkehr Hotel</td>
            </tr>
            </tbody>
        </table>
    </article>
</section>

<footer>
    <div>
        <h3>Kontakt</h3>
        <ul class="list">
            <li>Tel. 000 000 000</li>
            <li>Fax 000 000 000</li>
            <li>E-Mail: info@hotelvallora.com</li>
        </ul>
    </div>
</footer>

<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
