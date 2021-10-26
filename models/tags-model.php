<?php 
namespace App\Models;

// Include config file
require_once "../config.php";


class Tags
{
    protected $tag;
    protected $post_id;

    // GET METHODS
    public function getTag()
    {
        return $this->tag;
    }

    public function getPostID()
    {
        return $this->post_id;
    }

    // SET METHODS
    public function setTag(string $tag)
    {
        $this->tag = $tag;
    }

    public function setPostID(string $post_id)
    {
        $this->post_id = $post_id;
    }

    // CRUD OPERATIONS
    public function create(array $data, $mysqli) // Does this need $mysqli?
    {
        // attempt insert query execution
        $sql = "INSERT INTO tags(
            tag,
            post_id
        )
        VALUES(
            '$this->tag',
            '$this->post_id',
        )";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords added successfully to tags table.");
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
            tag,
            post_id
            FROM tags
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
        $sql = "UPDATE tags
        SET
            tag = '$this->tag',
            post_id = '$this->post_id'
        WHERE save_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to tags table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function delete(int $id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM tags
        WHERE save_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to tags table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }
}

?>