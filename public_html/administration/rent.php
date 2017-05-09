<?php

require_once(realpath(dirname(__FILE__) . "/../../resources/config.php"));
$db = GetDB();

$action = empty($_GET['action']) ? $_POST['action'] : $_GET['action'];
if($action == 'detail') {
    $rent = $db->GetRent($_GET['id']);
}
if($action == 'confirm') {
    $rent = $db->GetRent($_POST['id']);
    $db->UpdateRentStatus($rent['id'], 2);
    $action = 'detail';
}

?>

<?php require "./../../template/admin/header.php"; ?>
<?php if($action == 'detail'): ?>
<atricle id="rent">
    <h1>Buchung's Detail</h1>

    <?php if($rent['fk_rentstatus'] == 1): ?>
    <form aciton="rent.php" method="post">
        <input type="hidden" name="action" value="confirm"" />
        <input type="hidden" name="id" value="<?php echo $rent['id']; ?>" />
        <input type="submit" value="Bestätigen" />
    </form>
    <?php endif; ?>

    <ul>
    <?php foreach($rent as $key => $value): ?>
        <li><?php echo $key; ?>: <?php echo $value; ?></li>
    <?php endforeach; ?>
    </ul>
</atricle>
<?php else: ?>
<atricle id="rent">
    <h1>Buchungsverwaltung</h1>
    <p>Verwalten sie die Buchungen.</p>

    <h2>Zur überprüfung offene Buchungen</h2>
    <p>Folgende Buchungen müssen manuel geprüft und bestätigt werden.</p>

    <ul class="rent-list rent-open">
    <?php foreach($db->SelectRent(['fk_rentStatus' => 1]) as $rent): ?>
        <li><a href="rent.php?action=detail&id=<?php echo $rent['ID']; ?>"><?php echo $rent['ID']; ?></a></li>
    <?php endforeach; ?>
    </ul>
</atricle>
<?php endif; ?>
<?php require "./../../template/admin/footer.php"; ?>
