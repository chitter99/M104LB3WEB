<?php

class hotel
{
    public $db;

    function __construct($arg1)
    {
        $this->db = $arg1;
    }

    public function GetRoom($id) {
        $room = $this->db->GetRoom($id);
        $room['']

    }
}

?>