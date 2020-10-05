<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    include_once '../config/database.php';
    include_once '../class/categories.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Category($db);

    $stmt = $items->getCategories();

    if($stmt->rowCount() > 0){

        $category_arr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "remark" => $remark,
                "created_date" => $created_date,
                "updated_date" => $updated_date
            );

            array_push($category_arr, $e);
        }
        echo json_encode($category_arr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>
