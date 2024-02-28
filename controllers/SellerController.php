<?php
namespace controllers;

use models\Seller;
use helpers\Api;

class SellerController {
    
    public function create($request){

        $request = (object)$request;
        $seller = Seller::store($request->name,$request->email,$request->phone);
        Api::response($seller,$seller->ok ? 200 : 400);

    }
    
    public function get($request){

        $request = (object)$request;
        $seller = Seller::get($request->id);
        Api::response($seller,$seller->ok ? 200 : 400);

    }
    
    public function update(){
    }
    
    public function delete(){
    }
}
?>
