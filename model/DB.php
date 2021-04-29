<?php


class DB
{
    private $hostname = "localhost";
    private $database = "waddproject";
    private $username = "root";
    private $password = "";

    public function __construct()
    {
        $this->conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->database) or die(mysqli_connect_error());
        // echo $this->conn;
    }

    public function searchByName()
    {
        $query = "SELECT first_name, last_name FROM user";
        // $query = "SELECT IF(ISNULL(firstname), lastname, CONCAT(firstname, ' ', lastname)) AS fullname FROM user";
        $result = $this->conn->query($query);
        // print_r($result);
        // echo nl2br("\n\n");
        // echo($rs);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        return $row;
    }
}

