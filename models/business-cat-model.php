<?php 
namespace App\Models;


class BusinessCat
{
    protected $categoryID;
    protected $business_id;

    // GET METHODS
    public function getCategoryID()
    {
        return $this->categoryID;
    }

    public function getBusiness_id()
    {
        return $this->business_id;
    }

    // SET METHODS
    public function setCategoryID(string $categoryID)
    {
        $this->categoryID = $categoryID;
    }

    public function setBusiness_id(string $business_id)
    {
        $this->business_id = $business_id;
    }

    // CRUD OPERATIONS
    public function create(array $data, $mysqli) // Does this need $mysqli?
    {
        // attempt insert query execution
        $sql = "INSERT INTO business_category(
            category_id,
            business_id,
        )
        VALUES(
            '$this->categoryID',
            '$this->business_id',
        )";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords added successfully to business_category table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function read(int $id, $mysqli)
    {
        // attempt SELECT query execution
        $sql = "SELECT
            category_id,
            business_id
            FROM business_category
            WHERE business_category_id = '$id'
        ";

        if ($result = $mysqli -> query($sql)) {
            $obj = $result -> fetch_object();
            $result -> free_result();
            return $obj;   
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
        }
    }

    public function update(int $id, $mysqli)
    {
        // attempt insert query execution
        $sql = "UPDATE business_category
        SET 
            category_id = '$this->categoryID',
            business_id = '$this->business_id'
        WHERE business_category_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to business_category table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function delete(int $id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM business_category
        WHERE business_category_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to business_category table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }
}

?>