<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
$db = GetDB();

if(!isset($_GET['type']) || !isset($_POST['type']) || !isset($_SESSION['form']['searchroom']['from']) || !isset($_SESSION['form']['searchroom']['to'])) header('Location: rooms.php');
$booked = false;

if($_POST['type']) {
    $booked = true;
    $rentId = $db->RegisterRent();

} else {
    $roomType = $db->GetRoomType($_GET['type']);
}

?>

<html>
<body>
    <?php if(!booked): ?>
    <p>You selected <?php echo $roomType['name']; ?> as room type.</p>
    <form action="" method="POST">
        <input type="hidden" name="type" value="<?php echo $roomType['ID']; ?>" />
        <input type="hidden" name="from" value="<?php echo $_GET['']; ?>"
        <lable for="name">Vorname: </lable><input type="text" name="name" />
        <lable for="name">Nachname: </lable><input type="text" name="lastname" />
        <lable for="adresse">Adresse: </lable><input type="text" name="adress" />
        <lable for="city">City: </lable>
        <select name="city">
        <?php foreach($db->GetAllCity() as $city): ?>
            <option value="<?php echo $city['ID']; ?>"><?php echo $city['plz'] . ' ' . $city['city']; ?></option>
        <?php endforeach; ?>
        </select>
        <select name="title">
            <?php foreach($db->GetAllCity() as $city): ?>
                <option value="<?php echo $city['ID']; ?>"><?php echo $city['plz'] . ' ' . $city['city']; ?></option>
            <?php endforeach; ?>
        </select>
    </form>
    <?php else: ?>
    <p>You successfully booked your room!</p>
    <?php endif; ?>
</body>
</html>
