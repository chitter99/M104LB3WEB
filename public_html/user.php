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

?>

<?php require "./../template/header-booking.php"; ?>
<?php if($action == "view"): ?>
<article id="user">
    <h1>Deine Buchung</h1>
    <p>Zimmer Type: <?php $db->GetRoomType($rent['fk_roomType'])['name'] ?></p>
    <button onclick="hotel.storRent('<?php echo $_GET['id']; ?>')">Buchung Abrechen</button>
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
