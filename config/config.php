<?php
require_once(dirname(__FILE__) . '/../../../config/config.php');
require_once(dirname(__FILE__) . '/../include/constant.php');    


class DBController
{
        private $host = "smlcrmdb.c1e80z56vnnv.ap-south-1.rds.amazonaws.com";
        private $user = "admin";
        private $password = "bd339354e50a4544b157474ac3134f0b";
        private $database = "crmsml";
        private $connection = "";

        function __construct()
        {
                $conn = $this->connectDB();
                $this->connection = $conn;
        }

        function connectDB()
        {
                $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database) or die("Error".mysqli_connect_error());
                return $conn;
        }
        function runQuery($query)
        {
                $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
                while ($row = mysqli_fetch_assoc($result)) {
                        $resultset[] = $row;
                }
                if (!empty($resultset))
                        return $resultset;
        }

        function numRows($query)
        {
                $result  = mysqli_query($this->connection, $query);
                $rowcount = mysqli_num_rows($result);
                return $rowcount;
        }

        function insertRows($query)
        {
                $result  = mysqli_query($this->connection, $query) OR DIE(mysqli_error($this->connection));
                $rowcount = mysqli_insert_id($this->connection);
                return $rowcount;
        }

        function updateRows($query)
        {
                $result  = mysqli_query($this->connection, $query);
                return $result;
        }
}
$db_handle = new DBController();
$Conn1 = $db_handle->connectDB()

?>
