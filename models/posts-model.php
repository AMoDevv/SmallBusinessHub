<?php 
namespace App\Models;

// Include config file
require_once "tags-model.php";

use App\Models\Tags as Tags;

class Posts
{
    protected $photo;
    protected $description;
    protected $business_id;
    protected $saves;
    protected $boost;

    // GET METHODS
    public function getPhoto()
    {
        return $this->photo;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getBusinessID()
    {
        return $this->business_id;
    }

    public function getSaves()
    {
        return $this->saves;
    }

    public function getBoost()
    {
        return $this->boost;
    }

    // SET METHODS
    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setBusinessID(string $business_id)
    {
        $this->business_id = $business_id;
    }

    public function setSaves(string $saves)
    {
        $this->saves = $saves;
    }

    public function setBoost(string $boost)
    {
        $this->boost = $boost;
    }

    // CRUD OPERATIONS
    public function create(array $data, $mysqli) // Does this need $mysqli?
    {
        // attempt insert query execution
        $sql = "INSERT INTO posts(
            photo,
            description,
            business_id,
            boost,
            saves,
        )
        VALUES(
            '$this->photo',
            '$this->description',
            '$this->business_id',
            '$this->boost',
            '$this->saves',
        )";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords added successfully to posts table.");
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
            photo,
            business_id,
            description,
            boost,
            saves
            FROM posts
            WHERE post_id = '$id'
        ";

        if ($result = $mysqli -> query($sql)) {
            $obj = $result -> fetch_object();
            $result -> free_result();
            $return = new Posts();
            $return->setPhoto($obj->photo);
            $return->setBusinessID($obj->business_id);
            $return->setDescription($obj->description);
            $return->setBoost($obj->boost);
            $return->setSaves($obj->saves);

            return $return;   
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
        }
    }

    public function postsForBusiness(int $id, $mysqli)
    {
        // attempt SELECT query execution
        $sql = "SELECT
            post_id,
            business_id,
            photo,
            description,
            boost,
            saves
            FROM posts
            WHERE business_id = '$id'
        ";

        $out = array();
        if ($result = $mysqli -> query($sql)) {
            // $obj = $result -> fetch_object();
            while ($row = $result -> fetch_object()) {
                $var = new Tags();
                $row->tags = $var->getPostTags($row->post_id, $mysqli);
                array_push($out, $row);
            }
            $result -> free_result();
            return $out;   
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
        }
    }

    public function update(int $id, $mysqli)
    {
        // attempt insert query execution
        $sql = "UPDATE posts
        SET 
            photo = '$this->photo',
            description = '$this->description',
            boost = '$this->boost',
            saves = '$this->saves',
        WHERE post_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to posts table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function delete(int $id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM posts
        WHERE post_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to posts table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function update_save(int $id, $saves, $mysqli)
    {

        $update_sql = "UPDATE posts
            SET 
                saves = '$saves'
            WHERE post_id = '$id'
        ";
            
        if (mysqli_query($mysqli, $update_sql)) {
            echo nl2br("\nRecords updated successfully to posts table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $update_sql. " . mysqli_error($mysqli));
            return False;
        }


    }


}

?>