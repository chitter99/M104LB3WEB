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
<article id="booking">
    <h1>Buchen</h1>
    <p>You selected <?php echo $roomType['name']; ?> as room type.</p>
    <form action="" method="POST">
        <input type="hidden" name="action" value="book" />
        <!--Meta Data-->
        <input type="hidden" name="type" value="<?php echo $search_type; ?>" />
        <input type="hidden" name="from" value="<?php echo $search_to; ?>" />
        <input type="hidden" name="to" value="<?php echo $search_from ?>" />

        <lable for="title">Anrede: </lable>
        <select name="title">
            <?php foreach($db->GetAllTitle() as $title): ?>
                <option value="<?php echo $title['ID']; ?>"><?php echo $title['title']; ?></option>
            <?php endforeach; ?>
        </select>
        <lable for="surname">Vorname:
          <input type="text" name="surname" />
        </lable>
        <lable for="name">Nachname:
          <input type="text" name="name" />
        </lable>
        <lable for="mail">Mail:
          <input type="text" name="mail" />
        </lable>
        <lable for="phone">Telefonnummer:
          <input type="text" name="phone" />
        </lable>
        <lable for="addresse">Adresse:
          <input type="text" name="address" />
        </lable>
        <lable for="birthday">Geburtstag:
          <input type="date" name="birthday" />
        </lable>
        <lable for="city">Stadt:
          <select name="city">
              <?php foreach($db->GetAllCity() as $city): ?>
              <option value="<?php echo $city['ID']; ?>"><?php echo $city['plz'] . ' ' . $city['city']; ?></option>
              <?php endforeach; ?>
          </select>
        </lable>
        <lable for="room">Room:
          <select name="room">
              <?php foreach($db->SelectRoom(['fk_roomType' => $roomType['ID']])->fetch_all(MYSQLI_ASSOC) as $room): ?>
                  <option value="<?php echo $room['ID']; ?>"><?php echo $room['roomNumber']; ?></option>
              <?php endforeach; ?>
          </select>
        </lable>
        <button type="submit">Buchen</button>
    </form>
</article>
<?php require "./../template/footer.php"; ?>
