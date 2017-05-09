<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
$db = GetDB();

if(!isset($_GET['id'])) header('location: index.php');
$rent = $db->GetRent($_GET['id']);

$action = "view";
if(isset($_GET['action'])) $action = $_GET['action'];

if($aciton == "cancel_conf") {
    $db->UpdateRentStatus($rent['id'], 4);
}
if($rent['fk_rentStatus'] == 4) $action = "canceled";
if($action == 'view') {
    $room = $db->GetRoom($rent['fk_room']);
    $roomType = $db->GetRoomType($room['fk_roomType']);
    $customer = $db->GetCustomer($rent['fk_customer']);
}

?>

<?php require "./../template/header-booking.php"; ?>
<?php if($action == "view"): ?>
<article id="user" class="main">
    <h1>Deine Buchung</h1>
    <p>Zimmer Type: <?php echo $roomType['name'] ?></p>
    <button onclick="hotel.storRent('<?php echo $_GET['id']; ?>')">Buchung Abrechen</button>
    <p>Totale Kosten für Buchung: <b><?php echo $rent['estTotalCosts']; ?> CHF</b></p>
    <form class="form-list">
    <ul class="list-vertical">
        <li>
            <ul class="list-horizontal">
                <li>
                    <label>Buchung von: <?php echo $rent['rentFrom']; ?></label>
                </li>
                <li>
                    <label>Buchung bis: <?php echo $rent['rentTo']; ?></label>
                </li>
            </ul>
        </li>
        <li>
            <label>Anrede: </label>
        </li>
        <li>
            <ul class="list-horizontal">
                <li>
                    <label for="lastname">Name: <?php echo $customer['surname']; ?></label>
                </li>
                <li>
                    <label for="firstname">Vorname: <?php echo $customer['name']; ?></label>
                </li>
            </ul>
        </li>
        <li>
            <label>Mail: <?php echo $customer['mail']; ?></label>
        </li>
        <li>
            <label>Telefonnummer: <?php echo $customer['phone']; ?></label>
        </li>
        <li>
            <label for="adress">Adresse: <?php echo $customer['address']; ?></label>
        </li>
        <li>
            <label for="adress">Geburtstag: <?php echo $customer['birthday']; ?></label>
        </li>
        <li>
            <label for="adress">
                Stadt:
            </label>
        </li>
        <li>
            <ul class="list-horizontal">
                <li>
                    <label for="adults">Erwachsene (18+): <?php echo $rent['adult']; ?></label>
                </li>
                <li>
                    <label for="childs">Kinder: <?php echo $rent['child']; ?></label>
                </li>
            </ul>
        </li>
    </ul>
    </form>
</article>
<?php endif; ?>
<?php if($action == "cancel"): ?>
    <script>
        window.onload = function() {
            if(confirm('Bist du dir sicher das du die Buchung abbrechen möchtest? Dies kann später nicht mehr geänder werden!')) {
                window.location.href = "user.php?id=<?php echo $_GET['id']; ?>&action=cancel_conf";
            } else {
                window.location.href = "user.php?id=<?php echo $_GET['id']; ?>";
            }
        };
    </script>
<?php endif; ?>
<?php if($action == "cancel_conf"): ?>
    <p>Deine Buchung wurde abbgebrochen!</p>
<?php endif; ?>
<?php if($action == "canceled"): ?>
    <p>Diese Buchung wurde abbgebrochen!</p>
<?php endif; ?>
<?php if($action == "done"): ?>
    <p>Diese Buchung ist bereits abgeschlossen!</p>
<?php endif; ?>
<?php require "./../template/footer.php"; ?>
