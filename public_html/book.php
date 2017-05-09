<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
$db = GetDB();

/*
 * This site should only be accessable after the rooms.php page
 */

$search_to = isset($_GET['to']) ? $_GET['to'] : $_POST['to'];
$search_from = isset($_GET['from']) ? $_GET['from'] : $_POST['from'];
$search_type = isset($_GET['type']) ? $_GET['type'] : $_POST['type'];
if(!isset($search_to) || !isset($search_from) || !isset($search_type)) header('Location: rooms.php');

// Should be fine now

if($_POST['action'] == "book") {
    $search_to = strtotime($search_to);
    $search_from = strtotime($search_from);
    $rentId = $db->RegisterRentForRoom($_POST['room'], [
        "name" => $_POST['name'],
        "surname" => $_POST['surname'],
        "mail" => $_POST['mail'],
        "address" => $_POST['address'],
        "city" => $_POST['city'],
        "title" => $_POST['title'],
        "phone" => $_POST['phone'],
        "birthday" => $_POST['birthday']
    ], $search_from, $search_to);
    header('Location: book-done.php?rentId='.$rentId);
} else {
    $roomType = $db->GetRoomType($search_type);
}

$template_breadcrumbs = [
    [
        'link' => 'rooms.php?to=' . $search_to . '&from=' . $search_from,
        'display' => 'Suchen'
    ],
    [
        'link' => 'book.php?to=' . $search_to . '&from=' . $search_from . '&type=' . $search_type,
        'display' => 'Buchen'
    ]
];

?>
<?php require "./../template/header-booking.php"; ?>
<?php require "./../template/booking-breadcrumb.php"; ?>
<article class="main" id="booking">
  <h1>Buchen</h1>
  <div class="roomtype_wrapper">
    <p class="book_title">Du hast <b><?php echo $roomType['name']; ?></b> als Raumart ausgewählt.</p>
  </div>
  <div class="space"></div>
  <form action="" method="POST" class="form-list">
    <input type="hidden" name="action" value="book" />
    <!--Meta Data-->
    <input type="hidden" name="type" value="<?php echo $search_type; ?>" />
    <input type="hidden" name="from" value="<?php echo $search_to; ?>" />
    <input type="hidden" name="to" value="<?php echo $search_from ?>" />
    <ul class="list-vertical">
      <li>
          <label>
              Anrede:
              <select id="dd" class="wrapper-dropdown-1" tabindex="1" autofocus name="title">
                  <option value="--Bitte wählen--">--Bitte Wählen--</option>
                  <?php foreach($db->GetAllTitle() as $title): ?>
                      <option value="<?php echo $title['ID']; ?>"><?php echo $title['title']; ?></option>
                  <?php endforeach; ?>
              </select>
          </label>
      </li>
      <li>
          <ul class="list-horizontal">
              <li>
                  <label for="lastname">Name* <input type="text" name="surname" placeholder="Müller"></label>
              </li>
              <li>
                  <label for="firstname">Vorname* <input type="text" name="name" placeholder="Peter"></label>
              </li>
          </ul>
      </li>
      <li>
          <label>Mail* <input type="text" name="mail" placeholder="Musterstrasse 20"></label>
      </li>
      <li>
          <label>Telefonnummer* <input type="text" name="phone" placeholder="000 0000 00 00"></label>
      </li>
      <li>
          <label for="adress">Adresse* <input type="text" name="address" placeholder="Musterstrasse 20"></label>
      </li>
      <li>
          <label for="adress">Geburtstag* <input size="5" type="date" name="birthday"></label>
      </li>
      <li>
          <label for="adress">
              Stadt*
              <select name="city">
                  <?php foreach($db->GetAllCity() as $city): ?>
                      <option value="<?php echo $city['ID']; ?>"><?php echo $city['plz'] . ' ' . $city['city']; ?></option>
                  <?php endforeach; ?>
              </select>
          </label>
      </li>
      <li>
          <ul class="list-horizontal">
              <li>
                  <label for="adults">Erwachsene (18+)*</label>
                  <input type="number" name="adults" placeholder="1" value="1">
              </li>
              <li>
                  <label for="childs">Kinder*</label>
                  <input type="number" name="childs" placeholder="0" value="0">
              </li>
          </ul>
      </li>
      <label>
          Raum:
          <select name="room">
              <?php foreach($db->SelectRoom(['fk_roomType' => $roomType['ID']])->fetch_all(MYSQLI_ASSOC) as $room): ?>
                  <option value="<?php echo $room['ID']; ?>"><?php echo $room['roomNumber']; ?></option>
              <?php endforeach; ?>
          </select>
      </label>
      <li>
          <input type="submit" class="button" value="Senden">
      </li>
    </ul>
    <div class="space"></div>
  </form>
</article>
<?php require "./../template/footer.php"; ?>
