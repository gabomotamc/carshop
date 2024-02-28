<?php
namespace models;

use core\DB;

class Seller {
    private $db;
    
    public function __construct(){
        $this->db = DB::connection();
    }
    
    static function store($name, $email, $phone){
        $query = $this->db->prepare("INSERT INTO sellers (name, email, phone) VALUES (?, ?, ?)");
        $query->bind_param("sss", $name, $email, $phone);
        
        if($query->execute()){
            return (object) [
                'ok' => true,
                'msg' => 'Seller saved successfully',
                'seller_id' => $this->pdo->lastInsertId(),
            ];
        } else {
            return (object) [
                'ok' => false,
                'msg' => 'Seller not saved',
                'seller_id' => null,
            ];
        }
    }
    
    static function get($seller_id){

        $query = $this->db->prepare("SELECT * FROM sellers WHERE id = ?");
        $query->bind_param("i", $seller_id);
        $query->execute();
        $result = $query->get_result();

        $seller = $result->fetch_assoc();

        if($seller){
            return (object) [
                'ok' => true,
                'msg' => 'Seller get successfully',
                'data' => $seller,
            ];
        } else {
            return (object) [
                'ok' => false,
                'msg' => 'Seller not get',
                'seller_id' => null,
            ];
        }        
        
    }

    static function all(){
        $query = $this->db->prepare("SELECT * FROM sellers");
        $query->execute();
        $result = $query->get_result();

        $seller = $result->fetch_assoc();
        
        return $seller;
    }
    
    static function updateSeller($seller_id, $name, $email, $phone){
        $query = $this->db->prepare("UPDATE sellers SET name = ?, email = ?, phone = ? WHERE id = ?");
        $query->bind_param("sssi", $name, $email, $phone, $seller_id);
        
        if($query->execute()){
            return true;
        } else {
            return false;
        }
    }
    
    static function deleteSeller($seller_id){
        $query = $this->db->prepare("DELETE FROM sellers WHERE id = ?");
        $query->bind_param("i", $seller_id);
        
        if($query->execute()){
            return true;
        } else {
            return false;
        }
    }
}
?>
