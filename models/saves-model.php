<?php 
namespace App\Models;

// Include config file
require_once "./models/posts-model.php";
use App\Models\Posts as Posts;


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

    
    public function get_likes(int $id, $mysqli)
    {
        $count_sql = "SELECT count(*) as c
            FROM saves
            WHERE post_id = '$id'
        ";

        if($result = $mysqli->query($count_sql)) {
            $row = $result -> fetch_object();
            return $row->c;

        } else {
            echo nl2br("\nERROR: Failed to execute $count_sql. " . mysqli_error($mysqli));
        }
    }

    // CRUD OPERATIONS
    public function create(array $data, $mysqli) // Does this need $mysqli?
    {
        if($this->save_exists($this->post_id, $this->user_id, $mysqli)){
            echo nl2br("\nERROR: Like Exists");
            return False;
        }


        // attempt insert query execution
        $sql = "INSERT INTO saves(
            post_id,
            general_user_id
        )
        VALUES(
            '$this->post_id',
            '$this->user_id'
        )";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords added successfully to saves table.");

            $likes = $this->get_likes($this->post_id, $mysqli);
            echo "$likes";

            $post = new Posts();
            if($post->update_save($this->post_id, $likes, $mysqli)){
                return True;
            } else {
                return False;
            }

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


    public function delete(int $post_id, int $general_user_id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM saves
        WHERE post_id = '$post_id' AND
        general_user_id = '$general_user_id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords added successfully to saves table.");

            $likes = $this->get_likes($this->post_id, $mysqli);

            $post = new Posts();
            if($post->update_save($this->post_id, $likes, $mysqli)){
                return True;
            } else {
                return False;
            }
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    
    public function deletePostsDeleteSaves(int $post_id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM saves
        WHERE post_id = '$post_id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords successfully removed to saves table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function save_exists(int $post_id, int $general_user_id, $mysqli){
        // attempt insert query execution
        $sql = "SELECT $post_id FROM saves
        WHERE post_id = '$post_id' AND
        general_user_id = '$general_user_id'
        ";

        if ($result = $mysqli->query($sql)) {
            if($result->num_rows > 0){
                return True;
            } else {
                return False;
            }
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }
}

?>