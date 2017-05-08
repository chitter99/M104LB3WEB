<?php

require_once(realpath(dirname(__FILE__) . "/../../resources/config.php"));
$db = GetDB();

?>

<?php require "./../../template/admin/header.php"; ?>
<atricle id="rent">
    <h1>Buchungsverwaltung</h1>
    <p>Verwalten sie die Buchungen.</p>

    <h2>Zur überprüfung offene Buchungen</h2>
    <p>Folgende Buchungen müssen manuel geprüft und bestätigt werden.</p>

    <ul class="rent-list rent-open">
    <?php foreach($db->SelectRent(['fk_rentStatus' => 1]) as $rent): ?>
        <li><?php echo $rent['ID']; ?> <button onclick="hote.rentDetails('<?php echo $rent['ID']; ?>')">Bestätigen</button></li>
    <?php endforeach; ?>
    </ul>

</atricle>
<?php require "./../../template/admin/footer.php"; ?>
