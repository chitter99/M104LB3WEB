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
        $this->insert("roomType", ['name' => 'Einzelzimmer', 'price' => 85.0, 'description' => 'Super Room']);
        $this->insert("roomType", ['name' => 'Doppelzimmer', 'price' => 120.0, 'description' => 'Geilo diese RAUM <3']);
        // tbl.title
        $this->insert("title", ['title' => 'Frau']);
        $this->insert("title", ['title' => 'Herr']);
        // tbl.city
        $this->insert("city", ['city' => 'Klosters', 'plz' => 9000]);
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
    public function InsertRent($roomId, $customerId, $bookFrom, $bookTo)
    {
        return $this->insert("rent", [
            "rentFrom" => $bookFrom,
            "rentTo" => $bookTo,
            "days" => round(abs($bookTo-$bookFrom)/86400),
            "registered" => time(),
            "fk_customer" => $customerId,
            "fk_rentstatus" => 1,
            "fk_room" => $roomId
        ]);
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

    // Misc Functions
    public function RegisterRentForRoom($roomId, $customerArr, $bookFrom, $bookTo)
    {
        if(!$this->GetIsRoom($roomId)) return false;
        $customerId = $this->InsertCustomer($customerArr['name'], $customerArr['surname'], $customerArr['mail'], $customerArr['address'], $customerArr['city'], $customerArr['title'], $customerArr['phone'], $customerArr['birthday']);
        $rentId = $this->InsertRent($roomId, $customerId, $bookFrom, $bookTo);
        return $rentId;
    }

}

?>