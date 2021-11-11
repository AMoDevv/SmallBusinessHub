<?php 
namespace App\Models;


class UserInterest
{
    protected $categoryID;
    protected $general_user_id;

    // GET METHODS
    public function getCategoryID()
    {
        return $this->categoryID;
    }

    public function getGeneral_user_id()
    {
        return $this->general_user_id;
    }

    // SET METHODS
    public function setCategoryID(string $categoryID)
    {
        $this->categoryID = $categoryID;
    }

    public function setGeneral_user_id(string $general_user_id)
    {
        $this->general_user_id = $general_user_id;
    }

    // CRUD OPERATIONS
    public function create(array $data, $mysqli) // Does this need $mysqli?
    {
        // attempt insert query execution
        $sql = "INSERT INTO interests(
            categoryID,
            general_user_id,
        )
        VALUES(
            '$this->categoryID',
            '$this->general_user_id',
        )";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords added successfully to interests table.");
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
            categoryID,
            general_user_id
            FROM interests
            WHERE interest_id = '$id'
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
        $sql = "UPDATE interests
        SET 
            categoryID = '$this->categoryID',
            general_user_id = '$this->general_user_id'
        WHERE interest_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to interests table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function delete(int $id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM interests
        WHERE interest_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to interests table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }
}


?>