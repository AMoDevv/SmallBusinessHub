<?php 
namespace App\Models;


class GeneralUser
{
    protected $firstName;
    protected $lastName;
    protected $dateOfBirth;
    protected $gender;
    protected $email;

    // GET METHODS
    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function getEmail()
    {
        return $this->email;
    }

    // SET METHODS

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    public function setDateOfBirth(string $dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function setGender(string $gender)
    {
        $this->gender = $gender;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    // CRUD OPERATIONS
    public function create(array $data, $mysqli) // Does this need $mysqli?
    {
        // attempt insert query execution
        $sql = "INSERT INTO general_user_information(
            firstName, 
            lastName, 
            dateOfBirth, 
            gender, 
            email
        )
        VALUES(
            '$this->firstName',
            '$this->lastName',
            '$this->dateOfBirth',
            '$this->gender',
            '$this->email'
        )";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords added successfully to general_user_information table.");
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
            firstName,
            lastName,
            dateOfBirth,
            email,
            gender
            FROM general_user_information
            WHERE account_id = '$id'
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
        $sql = "UPDATE general_user_information
        SET 
            image = '$this->image',
            firstName = '$this->firstName',
            lastName = '$this->lastName',
            dateOfBirth = '$this->dateOfBirth',
            email = '$this->email',
            gender = '$this->gender',
        WHERE account_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to general_user_information table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function delete(int $id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM general_user_information
        WHERE account_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to general_user_information table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }
}


?>