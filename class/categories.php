<?php
    class Category{

        // Connection
        private $conn;

        // Table
        private $db_table = "Categories";

        // Columns
        public $id;
        public $name;
        public $remark;
        public $created_date;
        public $updated_date;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getCategories(){
            $sqlQuery = "SELECT id, name, remark, created_date, updated_date
                        FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createCategory(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        remark = :remark, 
                        created_date = :created_date, 
                        updated_date = :updated_date";

            $stmt = $this->conn->prepare($sqlQuery);

            // bind data
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":remark", $this->remark);
            $stmt->bindParam(":created_date", $this->created_date);
            $stmt->bindParam(":updated_date", $this->updated_date);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getOneCategory(){
            $sqlQuery = "SELECT
                        id,
                        name,
                        remark,
                        created_date,
                        updated_date
                      FROM
                        ". $this->db_table ."
                    WHERE
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $dataRow['name'];
            $this->remark = $dataRow['remark'];
            $this->created_date = $dataRow['created_date'];
            $this->updated_date = $dataRow['updated_date'];
        }

        // UPDATE
        public function updateCategory(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        remark = :remark,
                        updated_date = :updated_date
                    WHERE 
                        id = :id";
            $stmt = $this->conn->prepare($sqlQuery);

            // bind data
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":remark", $this->remark);
            $stmt->bindParam(":updated_date", $this->updated_date);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteCategory(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>
