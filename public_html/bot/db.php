<?php 

$username = "yongoqpb_bot";
$host = "localhost";
$password = "24082003S@mandar";
$db = "yongoqpb_bot";


$con = mysqli_connect($host, $username, $password, $db);

class DB {
    public $con;
    public $chat_id;

    public function __construct($chat_id, $conn)
    {
        $this->chat_id = $chat_id;
        $this->con = $conn;
    }
}


?>