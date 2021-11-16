<?php 
namespace App\Models;

require_once "./models/posts-model.php";
use App\Models\Posts as Posts;

class BusinessInformation
{
    protected $business_name;
    protected $address_street;
    protected $address_number;
    protected $address_city;
    protected $address_district;
    protected $categories;
    protected $phone_number;
    protected $email;
    protected $image;
    protected $subscription;
    protected $description;
    protected $facebook;
    protected $instagram;
    protected $twitter;
    protected $website;

    // GET METHODS
    public function getBusinessName()
    {
        return $this->business_name;
    }

    public function getAddressStreet()
    {
        return $this->address_street;
    }

    public function getAddressNumber()
    {
        return $this->address_number;
    }

    public function getAddressCity()
    {
        return $this->address_city;
    }

    public function getAddressDistrict()
    {
        return $this->address_district;
    }

    public function getCategories()
    {
        return $this->categories;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getSubscription()
    {
        return $this->subscription;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getFacebook()
    {
        return $this->facebook;
    }

    public function getInstagram()
    {
        return $this->instagram;
    }

    public function getTwitter()
    {
        return $this->twitter;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    // SET METHODS
    public function setBusinessName(string $business_name)
    {
        $this->business_name = $business_name;
    }

    public function setAddressStreet(string $address_street)
    {
        $this->address_street = $address_street;
    }

    public function setAddressNumber(string $address_number)
    {
        $this->address_number = $address_number;
    }

    public function setAddressCity(string $address_city)
    {
        $this->address_city = $address_city;
    }

    public function setAddressDistrict(string $address_district)
    {
        $this->address_district = $address_district;
    }

    public function setCategories(array $categories)
    {
        $this->categories = $categories;
    }

    public function setPhoneNumber(string $phone_number)
    {
        $this->phone_number = $phone_number;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setSubscription(int $subscription)
    {
        $this->subscription = $subscription;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function setFacebook(string $facebook)
    {
        $this->facebook = $facebook;
    }

    public function setInstagram(string $instagram)
    {
        $this->instagram = $instagram;
    }

    public function setTwitter(string $twitter)
    {
        $this->twitter = $twitter;
    }

    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    // CRUD OPERATIONS
    public function create(array $data, $mysqli) // Does this need $mysqli?
    {
        // attempt insert query execution
        $sql = "INSERT INTO business_information(
            image,
            business_name,
            address_street,
            address_district,
            address_city,
            address_number,
            phone_number,
            facebook_url,
            instagram_url,
            twitter_url,
            website_url,
            email,
            description,
            subscription_id,
            account_id
        )
        VALUES(
            '$this->image',
            '$this->business_name',
            '$this->address_street',
            '$this->address_district',
            '$this->address_city',
            '$this->address_number',
            '$this->phone_number',
            '$this->facebook',
            '$this->instagram',
            '$this->twitter',
            '$this->website',
            '$this->email',
            '$this->description',
            '$this->subscription',
            '$this->id'
        )";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords added successfully to business_information table.");
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
            image,
            business_id,
            business_name,
            address_street,
            address_district,
            address_city,
            address_number,
            phone_number,
            facebook_url,
            instagram_url,
            twitter_url,
            website_url,
            email,
            description,
            subscription_id
            FROM business_information
            WHERE business_id = '$id'
        ";

        if ($result = $mysqli -> query($sql)) {
            $obj = $result -> fetch_object();
            $result -> free_result();
            $posts = new Posts();
            $obj->posts = $posts->postsForBusiness($obj->business_id, $mysqli);
            return $obj;   
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
        }
    }

    public function readByPostID(int $id, $mysqli)
    {
        // attempt SELECT query execution
        $sql = "SELECT
            image,
            b.business_id as business_id,
            business_name,
            address_street,
            address_district,
            address_city,
            address_number,
            phone_number,
            facebook_url,
            instagram_url,
            twitter_url,
            website_url,
            email,
            description,
            subscription_id
            FROM business_information as b
            JOIN (
                SELECT business_id
                FROM posts
                WHERE post_id = '$id'
            ) as c
            ON b.business_id = c.business_id 
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
        $sql = "UPDATE business_information
        SET 
            image = '$this->image',
            business_name = '$this->business_name',
            address_street = '$this->address_street',
            address_district = '$this->address_district',
            address_city = '$this->address_city',
            address_number = '$this->address_number',
            phone_number = '$this->phone_number',
            facebook_url = '$this->facebook',
            instagram_url = '$this->instagram',
            twitter_url = '$this->twitter',
            website_url = '$this->website',
            email = '$this->email',
            description = '$this->description',
            subscription_id = '$this->subscription'
        WHERE account_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to business_information table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function delete(int $id, $mysqli)
    {
        // attempt insert query execution
        $sql = "DELETE FROM business_information
        WHERE account_id = '$id'
        ";

        if (mysqli_query($mysqli, $sql)) {
            echo nl2br("\nRecords updated successfully to business_information table.");
            return True;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }

    public function getBusinessNames($mysqli)
    {
        $sql = "SELECT business_id, business_name, image
        FROM business_information 
        ";
       
        if ($result = $mysqli -> query($sql)) {
            $out = array();
            if($row = $result->fetch_object()){
                array_push($out, $row);
            }
            $result->free_result();
            return $out;
        } else {
            echo nl2br("\nERROR: Failed to execute $sql. " . mysqli_error($mysqli));
            return False;
        }
    }
}

?>