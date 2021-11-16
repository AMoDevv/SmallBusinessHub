<?php 
namespace App\Models;


class Category
{
    protected $name;
    protected $description;

    // GET METHODS
    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    // SET METHODS
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    // CRUD OPERATIONS
    public function create(array $data, $mysqli) // Does this need $mysqli?
    {
        // attempt insert query execution
        $sql = "INSERT INTO category(
            name,
            description
        )
        VALUES(
            '$this->name',
            '$this->description',
        )";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords added successfully to category table.");
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
            name,
            description
            FROM category
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

    public function getUniqueCategory($mysqli)
    {
        // attempt SELECT query execution
        $sql = "SELECT bc.category_id as id, c.name as name, b.photo as photo
        FROM business_category as bc
        JOIN category as c
        ON c.category_id = bc.category_id
        JOIN (
            SELECT business_id, max(post_id) as post, photo
            FROM posts
            GROUP BY business_id
        ) as b
        ON b.business_id = bc.business_id
        ;";

        $out = array();
        if ($result = $mysqli -> query($sql)) {
            // $obj = $result -> fetch_object();
            while ($row = $result -> fetch_object()) {
                // $row = $row->name;
                array_push($out, $row);
            }
            $result -> free_result();
            return $out;   
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
        }
    }
    
    public function getPostsByCategoryID($id,$mysqli)
    {
        // attempt SELECT query execution
        $sql = "SELECT p.post_id
        FROM posts as p
        JOIN (
            SELECT business_id
            FROM business_category
            WHERE category_id = $id
        ) as c
        on c.business_id = p.business_id
        ";

        $out = array();
        if ($result = $mysqli -> query($sql)) {
            // $obj = $result -> fetch_object();
            while ($row = $result -> fetch_object()) {
                array_push($out, $row->post_id);
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
        $sql = "UPDATE category
        SET
            name = '$this->name',
            description = '$this->description'
        WHERE save_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to category table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function delete(int $id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM category
        WHERE save_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to category table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }
}

?>