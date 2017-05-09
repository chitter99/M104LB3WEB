<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
$db = GetDB();

$search_from = isset($_GET['form']) ? strtotime($_GET['form']) : time();
$search_to = isset($_GET['to']) ? strtotime($_GET['to']) : strtotime("+1 week");

$_SESSION['form']['searchroom']['from'] = $search_from;
$_SESSION['form']['searchroom']['to'] = $search_to;

$template_breadcrumbs = [
    [
        'link' => 'rooms.php?to=' . $search_to . '&from=' . $search_from,
        'display' => 'Suchen'
    ]
];

?>

<?php require "./../template/header-booking.php"; ?>
<?php require "./../template/booking-breadcrumb.php"; ?>
<article class="main" id="main">
  <h1>Suchen</h1>
  <p class="roomSearchDescription">
    Finden Sie Ihr Traumzimmer. Für mehr Informationen über die Zimmer finden Sie auf der Startseite.
    <br>Bitte geben Sie den gewünschten Aufenthaltszeitraum ein.
  </p>
  <form action="" class="searchForm" method="get">
    <label for="from">Von</label><input class="margin dateInput" type="date" name="from" value="<?php echo date("Y-m-d", $search_from); ?>" />
    <label for="to">Bis</label><input class="margin dateInput" type="date" name="to" value="<?php echo date("Y-m-d", $search_to); ?>" />
    <button class="button" type="submit">Suchen</button>
    <?php echo !($search_from < $search_to) ? "<p class=\"failtext\">Das Startdatum darf nich kleiner sein als das Enddatum</p>" : ''; ?>
  </form>
  <div id="roomlist">
    <h2>Verfügbare Hotelzimmer</h2>
    <?php $rooms = 0; ?>
    <?php foreach($db->GetAllRoomTypeWhereRoomsAreAvariableInDataRange($search_from, $search_to) as $type): ?>
      <div class="type">
        <h3><?php echo $type['name'] ?></h3>
        <p class="feature-text"><?php echo utf8_encode($type['description']); ?></p>
        <?php if(isset($type['image'])): ?><img class="feature-image" src="<?php echo $type['image']; ?>" alt="<?php echo $type['name']; ?>" /><?php endif; ?>
        <span class="room-price">Pro Tag <b><?php echo $type['price']; ?></b> CHF</span>
        <div class="clear" id="top"></div>
        <button class="feature-submit button" onclick="javascript: hotel.redirectToBooking('<?php echo $type['ID']; ?>', '<?php echo date("Y-m-d", $search_from); ?>', '<?php echo date("Y-m-d", $search_to); ?>')">Buchen</button>
      </div>
      <div class="space"></div>
      <div class="clear" id="top"></div>
      <?php $rooms++; ?>
    <?php endforeach; ?>
    <?php if($rooms == 0): ?>
      <p style="text-align: center;">Momentan sind alle Zimmer für diesen Zeitraum ausgebucht!</p>
    <?php endif; ?>
  </div>
</article>
<?php require "./../template/footer.php"; ?>