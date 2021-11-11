<?php 
namespace App\Models;

class Account
{
    protected $username;
    protected $pwd;
    protected $created_at;
    protected $account_type;

    // GET METHODS
    public function getUsername()
    {
        return $this->username;
    }

    public function getPwd()
    {
        return $this->pwd;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getAccountType()
    {
        return $this->account_type;
    }

    // SET METHODS
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function setPwd(string $pwd)
    {
        $this->pwd = $pwd;
    }

    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;
    }

    public function setAccountType(string $account_type)
    {
        $this->account_type = $account_type;
    }

    // CRUD OPERATIONS
    public function create(array $data, $mysqli)
    {
        // attempt insert query execution
        $sql = "INSERT INTO account(
            username, 
            pwd, 
            created_at, 
            account_type
        )
        VALUES(
            '$this->username',
            '$this->pwd',
            '$this->created_at',
            '$this->account_type',
        )";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords added successfully to account table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function read(int $id, $mysqli)
    {
        // attempt SELECT query execution
        $sql = "SELECT username, account_type
            FROM account
            WHERE accountID = '$id'
        ";

        if ($result = $mysqli -> query($sql)) {
            $obj = $result -> fetch_object();
            $result -> free_result();
            return $obj;   
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
        }
    }

    public function login(string $username, string $pwd, $mysqli)
    {
        // attempt SELECT query execution
        $sql = "SELECT accountID
            FROM account
            WHERE username = '$username', pwd = '$pwd'
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
        $sql = "UPDATE account
        SET 
            image = '$this->image',
            username = '$this->username',
            pwd = '$this->pwd',
            created_at = '$this->created_at',
            account_type = '$this->account_type'
        WHERE account_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to account table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function delete(int $id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM account
        WHERE account_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to account table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }
}

?>