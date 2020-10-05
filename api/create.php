<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/categories.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Category($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->name = $data->name;
    $item->remark = $data->remark;
    $item->created_date = date('Y-m-d H:i:s');
    $item->updated_date = date('Y-m-d H:i:s');
    
    if($item->createCategory()){
        echo 'Category created successfully.';
    } else{
        echo 'Category could not be created.';
    }
?>