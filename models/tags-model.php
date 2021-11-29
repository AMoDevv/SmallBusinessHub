<?php 
namespace App\Models;


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

    public function getUniqueTags($mysqli)
    {
        // attempt SELECT query execution
        $sql = "SELECT a.tag as tag, p.photo as photo
        FROM posts as p
        JOIN (
                SELECT tag, MAX(post_id) as post FROM tags GROUP BY tag
            ) as a
        ON p.post_id = a.post; 
        ";

        $out = array();
        if ($result = $mysqli -> query($sql)) {
            // $obj = $result -> fetch_object();
            while ($row = $result -> fetch_object()) {
                array_push($out, $row);
            }
            $result -> free_result();
            return $out;   
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
        }
    }
    
    public function getPostTags(int $id,$mysqli)
    {
        // attempt SELECT query execution
        $sql = "SELECT tag
        FROM tags
        WHERE post_id = $id
        ";

        $out = array();
        if ($result = $mysqli -> query($sql)) {
            // $obj = $result -> fetch_object();
            while ($row = $result -> fetch_object()) {
                array_push($out, $row);
            }
            $result -> free_result();
            return $out;   
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
        }
    }

    public function getPostsByTag($tag,$mysqli)
    {
        // attempt SELECT query execution
        $sql = "SELECT post_id
        FROM tags
        WHERE tag LIKE '$tag'
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

    
    public function deletePostsDeleteTags(int $post_id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM tags
        WHERE post_id = '$post_id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords successfully removed to tags table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }
}

?>