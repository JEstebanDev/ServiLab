<?php
class BaseDatos {

    private static $host = "localhost";
    private static $user = "root";
    private static $pass = "";
    private static $db = "gitse";
    private static $debug = 0;

    private $connection = null;
    
    public function __construct($host="localhost", $user="root", $pass="", $db="gitse", $debug=0) {
        self::$host = $host;
        self::$user = $user;
        self::$pass = $pass;
        self::$db = $db;
        self::$debug = $debug;
    }

    public static function select($sql) {

        if (self::$debug==1) {
            echo $sql;
        }

        $connection = new mysqli(self::$host,self::$user,self::$pass,self::$db);

        if ($connection->connect_error) {
            die("Connection failed: " .$connection->connect_error);
        }

        $result = null;

        $r = $connection->query($sql);

        if ($r->num_rows > 0) {

            $result = array();

            while($row = $r->fetch_assoc()) {
                $result[] = $row;
            }
        }

        $connection->close();
        return $result;
    }

    public static  function insert($sql) {

        if (self::$debug==1) {
            echo $sql;
        }

        $connection = new mysqli(self::$host,self::$user,self::$pass,self::$db);

        if ($connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $status = $connection->query($sql);

        $connection->close();

        return $status;
    }

    public static function update($sql) {

        if (self::$debug==1) {
            echo $sql;
        }

        $connection = new mysqli(self::$host, self::$user, self::$pass,self::$db);

        if ($connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $status = $connection->query($sql);

        $connection->close();

        return $status;
    }

    public function delete($sql) {

        if ($this->debug==1) {
            echo $sql;
        }

        $connection = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }

        $status = $connection->query($sql);

        $connection->close();

        return $status;
    }
}
?>
