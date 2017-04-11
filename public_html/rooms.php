<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
$db = GetDB();

$search_from = isset($_GET['form']) ? $_GET['form'] : time();
$search_to = isset($_GET['to']) ? $_GET['to'] : strtotime("+1 week");

?>

<html>
<head>
    <script src="./js/hotel.js"></script>
</head>
<body>
    <form action="" method="get">
        <label for="from">Von</label><input type="date" name="from" value="<?php echo date("Y-m-d", $search_from); ?>" />
        <label for="to">Bis</label><input type="date" name="to" value="<?php echo date("Y-m-d", $search_to); ?>" />
        <button type="submit">Suchen</button>
    </form>
    <div id="roomlist">
        <?php foreach($db->GetAllRoomsAvariableFromDateRange($search_from, $search_to) as $room): ?>
        <article class="room">
            <?php $type = $db->GetRoomType($room['fk_roomType']); ?>
            <h1><?php echo $type['name'] . ' Nr. ' . $room['roomNumber']; ?></h1>
            <p><?php echo $type['description']; ?></p>
            <button onclick="javascript: hotel.book(<?php echo $room['roomNumber']; ?>)">Book</button
        </article>
        <?php endforeach; ?>
    </div>
</body>
</html>

