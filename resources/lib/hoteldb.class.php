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
        $this->insert("roomType", ['name' => 'Einzelzimmer', 'price' => 85.0, 'description' => '']);
        $this->insert("roomType", ['name' => 'Doppelzimmer', 'price' => 120.0, 'description' => '']);

        if(!isset($config)) require './../config.php';
        if($config['env'] == 'dev') {
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
    public function GetRoom($id) {

    }
    public function GetAllRoomsAvariableFromDateRange($from, $to)
    {
        $sql = "SELECT * FROM room";
        return $this->query($sql)->fetch_all(MYSQLI_ASSOC);
    }
}

?>