<?php

class Database{

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
        $res =  $this->mysqli->query($sql);
        if(!$res) throw new Exception("SQL Error: " . $this->mysqli->error);
        return $res;
    }

    public function whereSqlCompare($key, $value) {
        return '`' . $key . '` ' . (gettype($value) == "string" ? 'LIKE' : '=') . $this->parseTypeSave($value);
    }

    public function select($table, $columnsArr, $whereArr=null, $order=null)
    {
        $sql = "SELECT ";
        if($columnsArr[0] == "*") {
            $sql .= "* ";
        } else {
            $sql .= $this->parseArrayToSQLList($columnsArr, "`") . " ";
        }
        $sql .= "FROM $table ";
        if(isset($whereArr)) {
            $sql .= "WHERE ";
            $last = end($whereArr);
            foreach($whereArr as $key=>$value)
            {
                $sql .= $this->whereSqlCompare($key, $value) . ($last == $value ? '' : ', ');
            }
        }
        return $this->query($sql . ";");
    }

    public function queryFile($file)
    {
        return $this->query(file_get_contents($file));
    }

    public function execStoredProcedure($name, $parameters)
    {
        $this->query();
    }

    public function parseTypeSave($value)
    {
        if($value == null) return "null";
        switch (gettype($value))
        {
            case "string": return "'".$value."'";
            case "object": return null;
            case "array": return $this->parseArrayToSQLList($value, null);
            case "boolean": return $value ? "true" : "false";
            default: return $value;
        }
    }

    public function parseArrayToSQLList($arr, $glue=null)
    {
      //for($i = 0, $len = count($arr); $i < $len; ++$i) $arr[$i] = $glue == null ? $this->parseTypeSave($arr[$i]) : $glue . $arr[$i] . $glue;
      for($i=0;$i < count($arr);$i++)
      {
        if($glue == null)
        {
          $arr[$i] = $this->parseTypeSave($arr[$i]);
        }
        else
        {
          $arr[$i] = $glue . $arr[$i] . $glue;
        }
      }
      return implode(",", $arr);
    }

    public function insert($table, $data)
    {
        $sql = "INSERT INTO `$table`(" . $this->parseArrayToSQLList(array_keys($data), '`') . ") VALUES (" . $this->parseArrayToSQLList(array_values($data)) . ");";
        if(!$this->query($sql)) return false;
        return $this->mysqli->insert_id;
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

    public function dateToSQL($date) {
        return "str_to_date('" + date("Y.m.d", $date) + "', '%Y.%m.%d')";
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