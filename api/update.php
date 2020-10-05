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

    $item->id = $data->id;
    $item->name = $data->name;
    $item->remark = $data->remark;
    $item->updated_date = date('Y-m-d H:i:s');

    if($item->updateCategory()){
        echo json_encode("Category data updated.");
    } else{
        echo json_encode("Data could not be updated");
    }
?>
