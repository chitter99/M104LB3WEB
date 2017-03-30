<?php

require_once("database.class.php");

class HotelDB extends Database
{

    public function build()
    {
        $this->queryFile(realpath(RESOURCES_PATH . '/db/build.sql'));
    }

    public function seed()
    {
        // tbl.rentStatus
        $this->insert("rentStatus", ['status' => 'registered']);
        $this->insert("rentStatus", ['status' => 'confirmed']);
        $this->insert("rentStatus", ['status' => 'paid']);
        $this->insert("rentStatus", ['status' => 'canceled']);
        // tbl.invoiceStatus
        $this->insert("invoiceStatus", ['status' => 'open']);
        $this->insert("invoiceStatus", ['status' => 'sent']);
        $this->insert("invoiceStatus", ['status' => 'paid']);
        $this->insert("invoiceStatus", ['status' => 'canceled']);
        // tbl.roomStatus
        $this->insert("roomStatus", ['status' => 'avariable']);
        $this->insert("roomStatus", ['status' => 'rent']);
        $this->insert("roomStatus", ['status' => 'closed']);

        return;
        // tbl.roomType
        $this->insert("roomType", ['name' => 'Einzelzimmer', 'price' => 85.0, 'description' => '']);
        $this->insert("roomType", ['name' => 'Doppelzimmer', 'price' => 120.0, 'description' => '']);
        // tbl.room
        $this->insert("room", ['number' => 100, 'type' => 1, 'status' => 1]);
        $this->insert("room", ['number' => 101, 'type' => 2, 'status' => 1]);
    }

    // tbl.RentStatus
    public function GetRentStatus()
    {
        return $this->FilterRentStatus();
    }
    public function FilterRentStatus($filter="1=1")
    {
        return $this->query("SELECT * FROM RentStatus WHERE ".$filter);
    }
    public function FilterRentStatusArr($filter)
    {
        return $this->FilterRoomStatus($filter)->fetch_all(MYSQLI_ASSOC);
    }
    // tbl.InvoiceStatus
    public function GetInvoiceStatus()
    {
        return $this->FilterInvoiceStatus();
    }
    public function FilterInvoiceStatus($filter="1=1")
    {
        return $this->query("SELECT * FROM InvoiceStatus WHERE ".$filter);
    }
    public function FilterInvoiceStatusArr($filter)
    {
        return $this->FilterRoomStatus($filter)->fetch_all(MYSQLI_ASSOC);
    }
    // tbl.RoomStatus
    public function GetRoomStatus()
    {
        return $this->FilterRoomStatus();
    }
    public function FilterRoomStatus($filter="1=1")
    {
        return $this->query("SELECT * FROM RoomStatus WHERE ".$filter);
    }
    public function FilterRoomStatusArr($filter="1=1")
    {
        return $this->FilterRoomStatus($filter)->fetch_all(MYSQLI_ASSOC);
    }
}

?>