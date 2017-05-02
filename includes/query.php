<?php

require_once('constants.php');


class db_conn  // https://www.binpress.com/tutorial/using-php-with-mysql-the-right-way/17
{
    // The database connection
    protected static $connection;
    private $username;
    private $password;
    private $dbname;

    function __construct($username, $password, $dbname)
    {
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        self::$connection = new mysqli('localhost', $username, $password, $dbname);
    }

    function __destruct()
    {
        self::$connection->close();
    }

    /**
     * Connect to the database
     *
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public function connect()
    {
        // Try and connect to the database
        if(!isset(self::$connection))
        {
            // Load configuration as an array. Use the actual location of your configuration file
            $config = parse_ini_file('./config.ini');
            self::$connection = new mysqli('localhost',$config['username'],$config['password'],$config['dbname']);
        }

        // If connection was not successful, handle the error
        if(self::$connection === false)
        {
            die(DEFAULT_ERROR_MSG);
            return false;
        }
        return self::$connection;
    }

    /**
     * Execute a prepared statement
     *
     * @param $mysqli_stmt The prepared statement with variables bound.
     * @return mixed The result of the mysqli::query() function
     */
    public function execute($stmt)
    {
        // Query the database
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result)
        {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $rows;
        }
        echo self::error();
        return $result;
    }

    /**
     * Create a prepared statement
     *
     * @param $query The query string
     * @return mysqli_stmt The prepared mysqli statement
     */
    public function prepare($query) {
        // Connect to the database
        $connection = $this -> connect();

        // Query the database
        $stmt = $connection->prepare($query);

        return $stmt;
    }

    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function query($query) {
        // Connect to the database
        $connection = $this -> connect();

        // Query the database
        $result = $connection ->query($query);

        if ($result)
        {
            echo self::error();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false)
        {
            return false;
        }
        while ($row = $result -> fetch_assoc())
        {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Fetch the last error from the database
     *
     * @return string Database error message
     */
    public function error()
    {
        $connection = $this->connect();
        return $connection->error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    }
}

$creds = array();
if ($handle = fopen(CREDENTIALS_FILE, "r"))
{
    for ($i = 0; $i < 3 && ($line = fgets($handle)) !== false; ++$i)
    {
        array_push($creds, trim($line));
    }

    fclose($handle);
}
else { die(DEFAULT_ERROR_MSG); }

$db = new db_conn($creds[0], $creds[1], $creds[2]);
