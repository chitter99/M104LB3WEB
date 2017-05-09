<?php

require_once("database.class.php");

class HotelDB extends Database
{

    public function build()
    {
        $this->queryFile(realpath(RESOURCES_PATH . '/db/hotel.sql'));
    }

    public function seed()
    {
        // tbl.rentStatus
        $this->insert("rentStatus", ['status' => 'registered']);
        $this->insert("rentStatus", ['status' => 'confirmed']);
        $this->insert("rentStatus", ['status' => 'paid']);
        $this->insert("rentStatus", ['status' => 'canceled']);
        // tbl.invoiceStatus
        $this->insert("invoiceStatus", ['status' => 'registered']);
        $this->insert("invoiceStatus", ['status' => 'sent']);
        $this->insert("invoiceStatus", ['status' => 'paid']);
        $this->insert("invoiceStatus", ['status' => 'canceled']);
        // tbl.roomStatus
        $this->insert("roomStatus", ['status' => 'avariable']);
        $this->insert("roomStatus", ['status' => 'closed']);
        // tbl.roomType
        $this->insert("roomType", ['name' => 'Einzelzimmer', 'price' => 85.0, 'description' => 'Die Hotelanlage zählt wohl zu den schönsten an der Algarve und ist ideal für Familien und junge Paare geeignet. Sie liegt zwischen Albufeira und Vilamoura, nur ca. 300m von den Stränden Falésia (Zugang über Treppen) entfernt und bietet somit beste Voraussetzungen für einen traumhaften Badeurlaub. Den Flughafen von Faro erreichen Sie nach ca. 40 Autominuten.', 'image' => './img/guestrooms/room1.jpg']);
        $this->insert("roomType", ['name' => 'Doppelzimmer', 'price' => 120.0, 'description' => 'Das Sport- und Ferienhotel liegt oberhalb des Meeres, inmitten einer großen Gartenanlage, mit direktem Zugang zum feinsandigen Strand „Praia da Falesia“. In ca. 500 m Entfernung befindet eine öffentliche Bar. Restaurants und Geschäfte erreichen Sie am Besten mit den PKW nach ca. 5 Minuten Fahrzeit. Nach Albufeira sind es ca. 13 km, zum Flughafen Faro etwa 35 km.', 'image' => './img/guestrooms/room2.jpg']);
        // tbl.title
        $this->insert("title", ['title' => 'Frau']);
        $this->insert("title", ['title' => 'Herr']);
        // tbl.city
        $this->insert("city", ['city' => 'Klosters', 'plz' => 7250]);
        $this->insert("city", ['city' => 'AchtZehnAchtZehn', 'plz' => 1818]);
        $this->insert("city", ['city' => 'Wetzikon', 'plz' => 8620]);

        if(!function_exists("GetConfig")) require_once './../config.php';
        if(GetConfig()['env'] == 'dev') {
            // tbl.room
            $this->insert("room", ['roomNumber' => 100, 'fk_roomType' => 1, 'fk_roomStatus' => 1]);
            $this->insert("room", ['roomNumber' => 101, 'fk_roomType' => 1, 'fk_roomStatus' => 2]);
            $this->insert("room", ['roomNumber' => 102, 'fk_roomType' => 2, 'fk_roomStatus' => 1]);
        }
    }

    // tbl.rentStatus
    public function GetAllRentStatus()
    {
        return $this->SelectRentStatus()->fetch_all(MYSQLI_ASSOC);
    }
    public function GetRentStatus($id)
    {
        return $this->SelectRentStatus(['id' => $id])->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function SelectRentStatus($where=null)
    {
        return $this->select('rentStatus', ['*'], $where);
    }
    // tbl.invoiceStatus
    public function GetAllInvoiceStatus()
    {
        return $this->SelectInvoiceStatus()->fetch_all(MYSQLI_ASSOC);
    }
    public function GetInvoiceStatus($id)
    {
        return $this->SelectInvoiceStatus(['id' => $id])->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function SelectInvoiceStatus($where=null)
    {
        return $this->select('invoiceStatus', ['*'], $where);
    }
    // tbl.roomStatus
    public function GetAllRoomStatus()
    {
        return $this->SelectRoomStatus()->fetch_all(MYSQLI_ASSOC);
    }
    public function GetRoomStatus($id)
    {
        return $this->SelectRoomStatus(['id' => $id])->fetch_all(MYSQLI_ASSOC);
    }
    public function SelectRoomStatus($where=null)
    {
        return $this->select('roomStatus', ['*'], $where);
    }
    // tbl.title
    public function GetAllTitle()
    {
        return $this->SelectTitle()->fetch_all(MYSQLI_ASSOC);
    }
    public function GetTitle($id)
    {
        return $this->SelectTitle(['id' => $id])->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function SelectTitle($where=null)
    {
        return $this->select('title', ['*'], $where);
    }
    // tbl.city
    public function GetAllCity()
    {
        return $this->SelectCity()->fetch_all(MYSQLI_ASSOC);
    }
    public function GetCity($id)
    {
        return $this->SelectCity(['id' => $id])->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function SelectCity($where=null)
    {
        return $this->select('city', ['*'], $where);
    }
    // tbl.roomType
    public function GetAllRoomType() {
        return $this->SelectRoomType()->fetch_all(MYSQLI_ASSOC);
    }
    public function GetRoomType($id) {
        return $this->SelectRoomType(['id' => $id])->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function SelectRoomType($where=null) {
        return $this->select('roomType', ['*'], $where);
    }
    public function GetAllRoomTypeWhereRoomsAreAvariableInDataRange() {
        return $this->query('SELECT * FROM roomType;');
    }
    // tbl.room
    public function GetAllRoom() {

    }
    public function GetRoom($roomId)
    {
        return $this->SelectRoom(['id' => $roomId])->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function GetAllRoomsAvariableFromDateRange($from, $to)
    {
        $sql = "SELECT * FROM room";
        return $this->query($sql)->fetch_all(MYSQLI_ASSOC);
    }
    public function GetIsRoom($roomId)
    {
        return $this->GetRoom($roomId) == null ? false : true;
    }
    public function SelectRoom($where=null)
    {
        return $this->select('room', ['*'], $where);
    }
    // tbl.Rent
    public function InsertRent($roomId, $customerId, $bookFrom, $bookTo, $adults, $childs)
    {
        return $this->insert("rent", [
            "rentFrom" => $bookFrom,
            "rentTo" => $bookTo,
            "registered" => time(),
            "fk_customer" => $customerId,
            "fk_rentstatus" => 1,
            "fk_room" => $roomId,
            "adult" => $adults,
            "child" => $childs
        ]);
    }
    public function GetRent($id)
    {
        return $this->SelectRent(['ID' => $id])->fetch_all(MYSQLI_ASSOC)[0];
    }
    public function SelectRent($where=null)
    {
        return $this->select('rent', ['*'], $where);
    }
    public function UpdateRentStatus($id, $new)
    {
        return $this->query("UPDATE `rent` SET `fk_rentstatus` = $new WHERE `id` = $id");
    }

    // tbl.Customer
    public function InsertCustomer($name, $surname, $mail, $address, $cityId, $titleId, $phone=null, $birthday=null)
    {
        return $this->insert("customer", [
            "name" => $name,
            "surname" => $surname,
            "mail" => $mail,
            "address" => $address,
            "fk_city" => $cityId,
            "fk_title" => $titleId,
            "phone" => $phone,
            "birthday" => $birthday
        ]);
    }
    public function GetCustomer($id)
    {
        return $this->SelectCustomer(['ID' => $id]);
    }
    public function SelectCustomer($where=null)
    {
        return $this->select('customer', ['*'], $where);
    }

    // Misc Functions
    public function RegisterRentForRoom($roomId, $customerArr, $bookFrom, $bookTo, $adults, $childs)
    {
        if(!$this->GetIsRoom($roomId)) return false;
        $customerId = $this->InsertCustomer($customerArr['name'], $customerArr['surname'], $customerArr['mail'], $customerArr['address'], $customerArr['city'], $customerArr['title'], $customerArr['phone'], $customerArr['birthday'], $customerArr['adults'], $customerArr['childs']);
        $rentId = $this->InsertRent($roomId, $customerId, $bookFrom, $bookTo, $adults, $childs);
        return $rentId;
    }

}

?>