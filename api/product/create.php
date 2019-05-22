<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:  application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//get databse connection
include_once '../config/database.php';

//instantiate product object
include_once '../objects/product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

//get posted data
$data = json_decode(file_get_contents("php://input"));

//make sure data is not empty
if(
    !empty($data->kode_barang) &&
    !empty($data->nama_barang) &&
    !empty($data->jenis_barang) &&
    !empty($data->harga)
){

    //set product property values
    $product->kode_barang = $data->kode_barang;
    $product->nama_barang = $data->nama_barang;
    $product->jenis_barang = $data->jenis_barang;
    $product->harga = $data->harga;

    //crate the product
    if($product->create()){

        //set response code- 201 created
        http_response_code(201);

        //tell the user
        echo json_encode(array("message" => "Product was created."));
    }

    //if unable to create the product, tell the user
    else{

        //set response code - 503 service unvailable
        http_response_code(503);

        //tell the user
        echo json_encode(array("message"=> "Unable to create product."));
    }
}

//tell the user data is incomplete
else{

    //set response code - 400 bad request
    http_response_code(400);

    //tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete"));
}
?>