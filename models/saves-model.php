<?php 
namespace App\Models;

// Include config file
require_once "../config.php";


class Saves
{
    protected $post_id;
    protected $user_id;

    // GET METHODS
    public function getPostID()
    {
        return $this->post_id;
    }

    public function getUserID()
    {
        return $this->user_id;
    }

    // SET METHODS
    public function setPostID(string $post_id)
    {
        $this->post_id = $post_id;
    }

    public function setUserID(string $user_id)
    {
        $this->user_id = $user_id;
    }

    // CRUD OPERATIONS
    public function create(array $data, $mysqli) // Does this need $mysqli?
    {
        // attempt insert query execution
        $sql = "INSERT INTO saves(
            post_id,
            general_user_id
        )
        VALUES(
            '$this->post_id',
            '$this->user_id',
        )";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords added successfully to saves table.");
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
            post_id,
            general_user_id
            FROM saves
            WHERE save_id = '$id'
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
        $sql = "UPDATE saves
        SET
            post_id = '$this->post_id',
            general_user_id = '$this->user_id'
        WHERE save_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to saves table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function delete(int $id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM saves
        WHERE save_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to saves table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }
}

?>