<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
$db = GetDB();

$search_from = isset($_GET['form']) ? strtotime($_GET['form']) : time();
$search_to = isset($_GET['to']) ? strtotime($_GET['to']) : strtotime("+1 week");

$_SESSION['form']['searchroom']['from'] = $search_from;
$_SESSION['form']['searchroom']['to'] = $search_to;

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
        <?php foreach($db->GetAllRoomTypeWhereRoomsAreAvariableInDataRange($search_from, $search_to) as $type): ?>
        <article class="type">
            <h1><?php echo $type['name'] ?></h1>
            <p><?php echo $type['description']; ?></p>
            <img src="<?php echo $type['image']; ?>" alt="<?php echo $type['name']; ?>" />
            <button onclick="javascript: hotel.book(<?php echo $room['roomNumber']; ?>)">Buchen</button>
        </article>
        <?php endforeach; ?>
    </div>
</body>
</html>

