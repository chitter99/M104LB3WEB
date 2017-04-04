<?php

class Database
{
    protected $host;
    protected $user;
    protected $pass;
    protected $database;

    private $connected = false;
    public $mysqli;

    function __construct($arg1, $arg2, $arg3, $arg4)
    {
        $this->host = $arg1;
        $this->user = $arg2;
        $this->pass = $arg3;
        $this->database = $arg4;
    }

    public function connect()
    {
        if($this->connected) $this->disconnect();
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->database);
        if ($this->mysqli->connect_errno)
        {
            echo "Failed to connect to MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        }
        $this->connected = true;
    }

    public function disconnect()
    {
        if(!$this->connected) return;
        $this->mysqli->disconnect();
        $this->connected = false;
    }

    public function query($sql)
    {
        if(!$this->connected) $this->connect();
        return $this->mysqli->query($sql);
    }

    public function select($table, $columnsArr, $whereArr=null, $order=null)
    {
        $sql = "SELECT ";
        $last = end($columnsArr);
        foreach($columnsArr as $co)
        {
            if($co == "*") {
                $sql = $sql . $co . ' ';
            } else {
                $sql = $sql . '`' . $co . '`' . ($last == $co ? ' ' : ', ');
            }
        }
        $sql .= "FROM $table ";
        if($whereArr != null) {
            $sql .= "WHERE ";
            $last = end($whereArr);
            foreach($whereArr as $key=>$value)
            {
                $sql = $sql . '`' . $co . '` ' . (gettype($value) == "string" ? 'LIKE' : '=') . ' ' . parseTypeSave($value) . ($last == $co ? ' ' : ', ');
            }
        }
        return $this->query($sql . ";");
    }

    public function queryFile($file)
    {

    }

    public function execStoredProcedure($name, $parameters)
    {
        $this->query();
    }

    public function parseTypeSave($value)
    {
        switch (gettype($value))
        {
            case "string": return "'".$value."'";
            case "object": return null;
            case "array": return null;
            case "boolean": return $value ? "true" : "false";
            default: return $value;
        }
    }

    public function insert($table, $data)
    {
        $affected = $values = "";
        $last = end($data);
        foreach($data as $row=>$value)
        {
            $suffix = ($last == $value) ? "" : ", ";
            $affected .= '`'.$row.'`'.$suffix;
            $values .=  $this->parseTypeSave($value) . $suffix;
        }
        $sql = "INSERT INTO `$table`($affected) VALUES ($values);";
        echo $sql;
        return $this->query($sql);
    }

    public function parameterToSqlFilter($para = ['1=1'])
    {
        $sql = "WHERE ";
        foreach($para as $p)
        {
            $sql .= $p . " AND ";
        }
        return $sql . "1=1";
    }

    public function build() {}

    public function seed() {}

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }
    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }
    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }
    /**
     * @param mixed $database
     */
    public function setDatabase($database)
    {
        $this->database = $database;
    }
}

?>