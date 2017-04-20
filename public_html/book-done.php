<?php

require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));
$db = GetDB();

if(!isset($_GET['rentId'])) header('Location: rooms.php');
$rent = $_GET['rentId'];

$template_breadcrumbs = [
    [
        'link' => 'rooms.php?to=' . $search_to . '&from=' . $search_from,
        'display' => 'Suchen'
    ],
    [
        'link' => 'book.php?to=' . $search_to . '&from=' . $search_from . '&type=' . $search_type,
        'display' => 'Buchen'
    ],
    [
        'link' => '',
        'display' => 'Fertig'
    ]
];

?>
<?php require "./../template/header-booking.php"; ?>
<?php require "./../template/booking-breadcrumb.php"; ?>
<article id="book">
    <p>You booked successfully. Your rent Id is <?php echo $rent; ?></p>
</article>
<?php require "./../template/footer.php"; ?>
