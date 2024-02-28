<?php
namespace migrations;

use core\DB;

class SellerMigration {
    private $db;
    
    public function __construct(){
        $this->db = DB::connection();
    }
    
    public function run(){

        $query = $this->db->prepare(
        "
            CREATE TABLE IF NOT EXISTS sellers (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(30),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );
        ");

        if($query->execute()){
            return true;
        } else {
            return false;
        }

    }

    public function drop(){

        $query = $this->db->prepare("DROP TABLE IF EXISTS sellers;");

        if($query->execute()){
            return true;
        } else {
            return false;
        }

    }    
}    