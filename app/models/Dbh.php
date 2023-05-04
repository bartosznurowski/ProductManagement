<?php 

declare(strict_types=1);

namespace App\Models;

use PDO;

class Dbh 
{
    private string $host = "localhost";
    private string $db_user = "root";
    private string $db_password = "";
    private string $db_name = "products";

    protected function connect() 
    {
        try {
            $dbh = New PDO("mysql:host=".$this->host.";dbname=".$this->db_name."",$this->db_user,$this->db_password);
            return $dbh;
        } catch(PDOException $e) {
            echo "Error: ".$e->getMessage()."<br>";
            die();
        }
    }
}