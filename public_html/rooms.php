<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
$db = GetDB();

$search_from = isset($_GET['form']) ? $_GET['form'] : time();
$search_to = isset($_GET['to']) ? $_GET['to'] : strtotime("+1 week");

?>

<?php require "./../template/header.php"; ?>
<article id="main">
  <h1>Suchen</h1>
  <form action="" class="" method="get">
    <label for="from">Von</label><input type="date" name="from" value="<?php echo date("Y-m-d", $search_from); ?>" />
    <label for="to">Bis</label><input type="date" name="to" value="<?php echo date("Y-m-d", $search_to); ?>" />
    <button type="submit">Suchen</button>
  </form>
  <div id="roomlist">
    <?php foreach($db->GetAllRoomTypeWhereRoomsAreAvariableInDataRange() as $type): ?>
      <article class="type">
        <h1><?php echo $type['name'] ?></h1>
        <p><?php echo $type['description']; ?></p>
        <img src="<?php echo $type['image']; ?>" alt="<?php echo $type['name']; ?>" />
        <button onclick="javascript: hotel.book(<?php echo $type['ID']; ?>)">Buchen</button>
      </article>
    <?php endforeach; ?>
  </div>
</article>
 <?php require "./../template/footer.php"; ?>